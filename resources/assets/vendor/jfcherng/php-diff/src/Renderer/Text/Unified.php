<?php

declare(strict_types=1);

namespace Jfcherng\Diff\Renderer\Text;

use Jfcherng\Diff\Differ;
use Jfcherng\Diff\SequenceMatcher;

/**
 * Unified diff generator.
 *
 * @see https://en.wikipedia.org/wiki/Diff#Unified_format
 */
final class Unified extends AbstractText
{
    /**
     * {@inheritdoc}
     */
    const INFO = [
        'desc' => 'Unified',
        'type' => 'Text',
    ];

    /**
     * {@inheritdoc}
     */
    protected function renderWorker(Differ $differ): string
    {
        $ret = '';

        foreach ($differ->getGroupedOpcodes() as $opcodes) {
            $lastItem = \count($opcodes) - 1;

            $i1 = $opcodes[0][1];
            $i2 = $opcodes[$lastItem][2];
            $j1 = $opcodes[0][3];
            $j2 = $opcodes[$lastItem][4];

            if ($i1 === 0 && $i2 === 0) {
                $i1 = $i2 = -1;
            }

            $ret .= $this->renderBlockHeader($i1 + 1, $i2 - $i1, $j1 + 1, $j2 - $j1);

            foreach ($opcodes as [$tag, $i1, $i2, $j1, $j2]) {
                if ($tag === SequenceMatcher::OP_EQ) {
                    $ret .= $this->renderContext(' ', $differ->getOld($i1, $i2));

                    continue;
                }

                if ($tag & (SequenceMatcher::OP_REP | SequenceMatcher::OP_DEL)) {
                    $ret .= $this->renderContext('-', $differ->getOld($i1, $i2));
                }

                if ($tag & (SequenceMatcher::OP_REP | SequenceMatcher::OP_INS)) {
                    $ret .= $this->renderContext('+', $differ->getNew($j1, $j2));
                }
            }
        }

        return $ret;
    }

    /**
     * Render the block header.
     *
     * @param int $a1 the a1
     * @param int $a2 the a2
     * @param int $b1 the b1
     * @param int $b2 the b2
     */
    protected function renderBlockHeader(int $a1, int $a2, int $b1, int $b2): string
    {
        return "@@ -{$a1},{$a2} +{$b1},{$b2} @@\n";
    }

    /**
     * Render the context array with the symbol.
     *
     * @param string $symbol  the symbol
     * @param array  $context the context
     */
    protected function renderContext(string $symbol, array $context): string
    {
        return empty($context)
            ? ''
            : $symbol . \implode("\n{$symbol}", $context) . "\n";
    }
}
