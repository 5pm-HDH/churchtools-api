<?php

namespace CTApi\Test\Integration\Exceptions;


use CTApi\Exceptions\CTModelException;
use CTApi\Models\Wiki\WikiPage\WikiPageTreeNode;
use PHPUnit\Framework\TestCase;

class ModelExceptionTest extends TestCase
{
    public function testNoRootWikiPage(): void
    {
        $this->expectException(CTModelException::class);
        WikiPageTreeNode::processWikiPagesReturnRootNode([]);
    }
}