<?php declare(strict_types=1);

namespace Microsoft\PhpParser;

/**
 * FilePositionMap can be used to get the line number for a large number of nodes (starting from 1).
 * It works the most efficiently when the requested node is close to the previously requested node.
 *
 * Other designs that weren't chosen:
 * - Precomputing all of the start/end offsets when initializing was slower - Some offsets weren't needed, and walking the tree was slower.
 * - Caching line numbers for previously requested offsets wasn't really necessary, since offsets are usually close together and weren't requested repeatedly.
 *
 * Future optimizations:
 */
class FilePositionMap
{
    /** @var string the full file contents */
    private $fileContents;

    /** @var int - Precomputed strlen($file_contents) */
    private $fileContentsLength;

    /** @var int the 0-based byte offset of the most recent request for a line number. */
    private $currentOffset;

    /** @var int the line number for $this->currentOffset (updated whenever currentOffset is updated) */
    private $lineForCurrentOffset;

    public function __construct(string $file_contents)
    {
        $this->fileContents = $file_contents;
        $this->fileContentsLength = \strlen($file_contents);
        $this->currentOffset = 0;
        $this->lineForCurrentOffset = 1;
    }

    /**
     * @param Node $node the node to get the start line for.
     * TODO deprecate and merge this and getTokenStartLine into getStartLine
     * if https://github.com/Microsoft/tolerant-php-parser/issues/166 is fixed,
     * (i.e. if there is a consistent way to get the start offset)
     */
    public function getNodeStartLine(Node $node) : int
    {
        return $this->getLineNumberForOffset($node->getStart());
    }

    /**
     * @param Node $node the node to get the start line for.
     */
    public function getTokenStartLine(Token $token) : int
    {
        return $this->getLineNumberForOffset($token->start);
    }

    /**
     * @param Node|Token $node
     */
    public function getStartLine($node) : int
    {
        if ($node instanceof Token) {
            $offset = $node->start;
        } else {
            $offset = $node->getStart();
        }
        return $this->getLineNumberForOffset($offset);
    }

    /**
     * @param Node|Token $node
     * Similar to getStartLine but includes the column
     */
    public function getStartLineCharacterPositionForOffset($node) : LineCharacterPosition
    {
        if ($node instanceof Token) {
            $offset = $node->start;
        } else {
            $offset = $node->getStart();
        }
        return $this->getLineCharacterPositionForOffset($offset);
    }

    /** @param Node|Token $node */
    public function getEndLine($node) : int
    {
        return $this->getLineNumberForOffset($node->getEndPosition());
    }

    /**
     * @param Node|Token $node
     * Similar to getStartLine but includes the column
     */
    public function getEndLineCharacterPositionForOffset($node) : LineCharacterPosition
    {
        return $this->getLineCharacterPositionForOffset($node);
    }

    /**
     * @param Node|Token $node
     * Similar to getStartLine but includes the column
     */
    public function getLineCharacterPositionForOffset(int $offset) : LineCharacterPosition
    {
        $line = $this->getLineNumberForOffset($offset);
        $character = $this->getColumnForOffset($offset);
        return new LineCharacterPosition($line, $character);
    }

    public function getLineNumberForOffset(int $offset) : int
    {
        if ($offset < 0) {
            $offset = 0;
        } elseif ($offset > $this->fileContentsLength) {
            $offset = $this->fileContentsLength;
        }
        $currentOffset = $this->currentOffset;
        if ($offset > $currentOffset) {
            $this->lineForCurrentOffset += \substr_count($this->fileContents, "\n", $currentOffset, $offset - $currentOffset);
            $this->currentOffset = $offset;
        } elseif ($offset < $currentOffset) {
            $this->lineForCurrentOffset -= \substr_count($this->fileContents, "\n", $offset, $currentOffset - $offset);
            $this->currentOffset = $offset;
        }
        return $this->lineForCurrentOffset;
    }

    /**
     * @return int - gets the 1-based column offset
     */
    public function getColumnForOffset(int $offset) : int
    {
        $length = $this->fileContentsLength;
        if ($offset <= 1) {
            return 1;
        } elseif ($offset > $length) {
            $offset = $length;
        }
        // Postcondition: offset >= 1, ($lastNewlinePos < $offset)
        // If there was no previous newline, lastNewlinePos = 0

        // Start strrpos check from the character before the current character,
        // in case the current character is a newline.
        $lastNewlinePos = \strrpos($this->fileContents, "\n", -$length + $offset - 1);
        return 1 + $offset - ($lastNewlinePos === false ? 0 : $lastNewlinePos + 1);
    }
}
