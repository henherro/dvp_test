<?php
namespace DVP\Blog\Model\Post;

use DVP\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use DVP\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;

class DataProvider extends AbstractDataProvider
{
    protected $collection;
    protected $commentCollectionFactory;
    protected $request;
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        PostCollectionFactory $collection,
        CommentCollectionFactory $commentCollectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collection->create();
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->request = $request;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $postId = $this->request->getParam($this->requestFieldName);
        $comments = [];
        $items = [];

        if ($postId) {
            $item = $this->collection->getItemById($postId);
            
            if ($item) {
                
                $commentCollection = $this->commentCollectionFactory->create();
                $commentCollection->addFieldToFilter('post_id', $postId);

                $comments = [];
                foreach ($commentCollection->getItems() as $comment) {
                    $comments[] = $comment->getData();
                }
                
                $item->setData('post_comments', $comments);

                $this->loadedData[$postId] = $item->getData();
                return $this->loadedData;
            }
        } else {
            
            foreach ($this->collection->getItems() as $item) {
                $items[] = $item->getData();
            }

            return [
                'totalRecords' => $this->collection->getSize(),
                'items' => $items
            ];
        }

        
    }
}
