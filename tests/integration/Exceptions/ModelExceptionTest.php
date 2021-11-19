<?php


use CTApi\Exceptions\CTModelException;
use CTApi\Models\WikiPageTreeNode;
use PHPUnit\Framework\TestCase;

class ModelExceptionTest extends TestCase
{
    public function testNoRootWikiPage(): void
    {
        $this->expectException(CTModelException::class);
        WikiPageTreeNode::processWikiPagesReturnRootNode([]);
    }
}