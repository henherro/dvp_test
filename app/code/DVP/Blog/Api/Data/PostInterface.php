<?php
namespace DVP\Blog\Api\Data;

interface PostInterface
{

    const POST_ID = 'post_id';
    const SHORT_CONTENT = 'short_content';
    const CONTENT = 'content';
    const STATUS = 'status';
    const TITLE = 'title';
    const URL_KEY = 'url_key';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get post_id
     * @return string|null
     */
    public function getPostId();

    /**
     * Set post_id
     * @param string $postId
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setPostId($postId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setTitle($title);

    /**
     * Get url_key
     * @return string|null
     */
    public function getUrlKey();

    /**
     * Set url_key
     * @param string $urlKey
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setUrlKey($urlKey);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setContent($content);

    /**
     * Get short_content
     * @return string|null
     */
    public function getShortContent();

    /**
     * Set short_content
     * @param string $shortContent
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setShortContent($shortContent);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setStatus($status);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \DVP\Blog\Post\Api\Data\PostInterface
     */
    public function setUpdatedAt($updatedAt);
}
