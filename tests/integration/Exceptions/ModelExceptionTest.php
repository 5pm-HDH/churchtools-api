<?php


use CTApi\Exceptions\CTModelException;
use CTApi\Models\WikiPageTreeNode;
use PHPUnit\Framework\TestCase;

class ModelExceptionTest extends TestCase
{
    public function testNoRootWikiPage()
    {
        $this->expectException(CTModelException::class);
        WikiPageTreeNode::processWikiPagesReturnRootNode([]);
    }
}