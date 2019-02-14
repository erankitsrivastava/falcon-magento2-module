<?php

namespace Deity\MagentoApi\Helper;

use Magento\Framework\App\Cache\Tag\Resolver\Proxy as TagResolver;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Registry;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    const RESPONSE_TAGS_REGISTRY = 'response_tags';

    /**
     * Default response tag sent in X-Cache-Tags header in REST
     */
    const defaultResponseTag = 'ApiMagento';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface 
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\App\Cache\Tag\Resolver\Proxy
     */
    protected $tagResolver;

    /**
     * @param Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Cache\Tag\Resolver\Proxy $tagResolver
     */
    public function __construct(
        Context $context,
        Registry $registry,
        StoreManagerInterface $storeManager,
        TagResolver $tagResolver
    ) {
        $this->registry     = $registry;
        $this->storeManager = $storeManager;
        $this->tagResolver  = $tagResolver;

        parent::__construct($context);
    }

    public function getAppLogoImg()
    {
        return $this->getConfigValue('app_logo_img');
    }

    public function getAppHomeUrl()
    {
        return $this->getConfigValue('app_home_url');
    }

    /**
     * Get config value
     *
     * @param string $key
     * @param string $scope
     * @param null $storeId
     * @return mixed
     */
    private function getConfigValue($key, $scope = ScopeInterface::SCOPE_STORE, $storeId = null)
    {
        $path = strstr($key, '/') ? $key : "deity/core/$key";
        return $this->scopeConfig->getValue($path, $scope, $storeId);
    }

    /**
     * Add tags to response tag registry
     *
     * @param mixed $tags
     * @throws \Exception
     */
    public function addResponseTags($tags)
    {
        if (!is_array($tags)) {
            $tags = [$tags];
        }

        $currentTags = $this->getResponseTags();
        if (!is_array($currentTags)) {
            $currentTags = [];
        }

        $tags = array_merge($currentTags, $tags);

        $this->setResponseTags($tags);
    }

    /**
     * Add response tags from object to registry
     *
     * @param mixed $object
     * @throws \Exception
     */
    public function addResponseTagsByObject($object)
    {
        $this->addResponseTags($this->tagResolver->getTags($object));
    }

    /**
     * Set list of response tags in registry
     *
     * @param mixed $tags
     * @throws \Exception
     */
    public function setResponseTags($tags)
    {
        if (null !== $tags && !is_array($tags)) {
            throw new \Exception('Not accepted argument');
        }

        $this->registry->unregister(self::RESPONSE_TAGS_REGISTRY);
        $this->registry->register(self::RESPONSE_TAGS_REGISTRY, $tags, true);
    }

    /**
     * List of collected response tags in registry
     *
     * @return array
     */
    public function getResponseTags()
    {
        return $this->registry->registry(self::RESPONSE_TAGS_REGISTRY);
    }

}
