<?php
namespace DVP\Blog\Api\Data;

interface PostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get post list.
     * @return \DVP\Blog\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set post_id list.
     * @param \DVP\Blog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
