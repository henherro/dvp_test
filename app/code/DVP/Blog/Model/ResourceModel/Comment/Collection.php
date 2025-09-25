<?php
namespace DVP\Blog\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use DVP\Blog\Model\Comment as CommentModel;
use DVP\Blog\Model\ResourceModel\Comment as CommentResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(CommentModel::class, CommentResource::class);
    }
}
