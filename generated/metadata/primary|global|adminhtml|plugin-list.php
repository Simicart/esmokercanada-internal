<?php return array (
  0 => 
  array (
    'Magento\\Framework\\DB\\Adapter\\AdapterInterface' => 
    array (
      'execute_commit_callbacks' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\Model\\ExecuteCommitCallbacks',
      ),
    ),
    'Magento\\Framework\\App\\Response\\Http' => 
    array (
      'genericHeaderPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Response\\HeaderManager',
      ),
      'magetrend-network-error-fix' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\App\\Response\\Http',
      ),
    ),
    'Magento\\Framework\\App\\ActionInterface' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Framework\\Url\\SecurityInfo' => 
    array (
      'storeUrlSecurityInfo' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\Url\\Plugin\\SecurityInfo',
      ),
    ),
    'Magento\\Framework\\Url\\RouteParamsResolver' => 
    array (
      'storeUrlRouteParamsResolver' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\Url\\Plugin\\RouteParamsResolver',
      ),
    ),
    'Magento\\Store\\Model\\Store' => 
    array (
      'themeDesignConfigGridIndexerStore' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Indexer\\Design\\Config\\Plugin\\Store',
      ),
    ),
    'Magento\\Framework\\App\\Config\\Initial\\Converter' => 
    array (
      'cron_system_config_initial_converter_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Cron\\Model\\System\\Config\\Initial\\Converter',
      ),
    ),
    'Magento\\Framework\\App\\FrontController' => 
    array (
      'install' => 
      array (
        'sortOrder' => 40,
        'instance' => 'Magento\\Framework\\Module\\Plugin\\DbStatusValidator',
      ),
      'storeCookieValidate' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Store\\Model\\Plugin\\StoreCookie',
      ),
    ),
    'Magento\\Cms\\Model\\Wysiwyg\\Images\\Storage' => 
    array (
      'media_gallery_image_remove_metadata_after_wysiwyg' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'Magento\\MediaGallery\\Plugin\\Wysiwyg\\Images\\Storage',
      ),
    ),
    'Magento\\AdvancedPricingImportExport\\Model\\Import\\AdvancedPricing' => 
    array (
      'invalidateAdvancedPriceIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdvancedPricingImportExport\\Model\\Indexer\\Product\\Price\\Plugin\\Import',
      ),
    ),
    'Magento\\Framework\\Url\\ScopeInterface' => 
    array (
      'urlSignature' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Url\\Plugin\\Signature',
      ),
    ),
    'Magento\\Theme\\Model\\DesignConfigRepository' => 
    array (
      'save_design_settings_event_dispatching' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Design\\Config\\Plugin',
      ),
    ),
    'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\CollectionFactory' => 
    array (
      'mageworx_ordersgrid_change_grid_collection' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\ChangeGridCollection',
      ),
    ),
    'Magento\\Store\\Model\\Website' => 
    array (
      'themeDesignConfigGridIndexerWebsite' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Indexer\\Design\\Config\\Plugin\\Website',
      ),
      'reindex_customer_grid_after_website_remove' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerGridIndexAfterWebsiteDelete',
      ),
      'reindex_after_delete_website' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Website',
      ),
    ),
    'Magento\\Store\\Model\\Group' => 
    array (
      'themeDesignConfigGridIndexerStoreGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Indexer\\Design\\Config\\Plugin\\StoreGroup',
      ),
    ),
    'Magento\\Config\\App\\Config\\Source\\DumpConfigSourceAggregated' => 
    array (
      'designConfigTheme' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Theme\\Model\\Design\\Config\\Plugin\\Dump',
      ),
    ),
    'Magento\\Framework\\Data\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Consumer\\Config\\CompositeReader' => 
    array (
      'queueConfigPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\MessageQueue\\Config\\Consumer\\ConfigReaderPlugin',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Publisher\\Config\\CompositeReader' => 
    array (
      'queueConfigPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\MessageQueue\\Config\\Publisher\\ConfigReaderPlugin',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Topology\\Config\\CompositeReader' => 
    array (
      'queueConfigPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\MessageQueue\\Config\\Topology\\ConfigReaderPlugin',
      ),
    ),
    'Magento\\Framework\\Amqp\\Bulk\\Exchange' => 
    array (
      'amqpStoreIdFieldForAmqpBulkExchange' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AmqpStore\\Plugin\\Framework\\Amqp\\Bulk\\Exchange',
      ),
    ),
    'Magento\\AsynchronousOperations\\Model\\MassConsumerEnvelopeCallback' => 
    array (
      'amqpStoreIdFieldForAsynchronousOperationsMassConsumerEnvelopeCallback' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AmqpStore\\Plugin\\AsynchronousOperations\\MassConsumerEnvelopeCallback',
      ),
    ),
    'Magento\\Framework\\App\\Config\\Value' => 
    array (
      'admin_system_config_media_gallery_renditions' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\UpdateRenditionsOnConfigChange',
      ),
      'admin_system_config_adobe_stock_save_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGallerySynchronization\\Plugin\\MediaGallerySyncTrigger',
      ),
      'webapiResourceSecurityCacheInvalidate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiSecurity\\Model\\Plugin\\CacheInvalidator',
      ),
    ),
    'Magento\\Authorization\\Model\\Role' => 
    array (
      'updateRoleUsersAcl' => 
      array (
        'sortOrder' => 20,
        'instance' => 'Magento\\User\\Model\\Plugin\\AuthorizationRole',
      ),
    ),
    'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute' => 
    array (
      'storeLabelCaching' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Eav\\Plugin\\Model\\ResourceModel\\Entity\\Attribute',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\AbstractEntity' => 
    array (
      'clean_cache' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Cache\\FlushCacheByTags',
      ),
    ),
    'Magento\\Customer\\Model\\ResourceModel\\Customer\\Collection' => 
    array (
      'amazon_login_customer_collection' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CustomerCollection',
      ),
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface' => 
    array (
      'transactionWrapper' => 
      array (
        'sortOrder' => -1,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerRepository\\TransactionWrapper',
      ),
      'login_as_customer_customer_repository_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\CustomerPlugin',
      ),
      'update_newsletter_subscription_on_customer_update' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Newsletter\\Model\\Plugin\\CustomerPlugin',
      ),
      'amazon_login_customer_repository' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CustomerRepository',
      ),
      'extensionAttributeVertexCustomerCode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerRepositoryPlugin',
      ),
      'extensionAttributeVertexCustomerCountry' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerCountryAttributePlugin',
      ),
    ),
    'Magento\\Directory\\Model\\AllowedCountries' => 
    array (
      'customerAllowedCountries' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\AllowedCountries',
      ),
    ),
    'Magento\\PageCache\\Observer\\FlushFormKey' => 
    array (
      'customerFlushFormKey' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerFlushFormKey',
      ),
    ),
    'Magento\\Customer\\Model\\AccountManagement' => 
    array (
      'security_check_customer_password_reset_attempt' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\AccountManagement',
      ),
      'AccountManagementPlugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Cart2Cart\\Login\\Plugin\\AccountManagement',
      ),
      'mz_osc_newaccount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\AccountManagement',
      ),
      'mpsmtp_account_management' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Smtp\\Plugin\\AccountManagement',
      ),
    ),
    'Magento\\Indexer\\Model\\Config\\Data' => 
    array (
      'indexerCategoryFlatConfigGet' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Flat\\Plugin\\IndexerConfigData',
      ),
      'indexerProductFlatConfigGet' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Flat\\Plugin\\IndexerConfigData',
      ),
    ),
    'Magento\\Indexer\\Model\\Processor' => 
    array (
      'page-cache-indexer-reindex-clean-cache' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Indexer\\Model\\Processor\\CleanCache',
      ),
    ),
    'Magento\\Framework\\Indexer\\ActionInterface' => 
    array (
      'cache_cleaner_after_reindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Indexer\\Model\\Indexer\\CacheCleaner',
      ),
    ),
    'Magento\\Catalog\\Model\\Product' => 
    array (
      'cms' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Cms\\Model\\Plugin\\Product',
      ),
      'catalogInventoryAfterLoad' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\AfterProductLoad',
      ),
      'add_bundle_parent_identities' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Bundle\\Model\\Plugin\\ProductIdentitiesExtender',
      ),
      'product_identities_extender' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Plugin\\ProductIdentitiesExtender',
      ),
      'exclude_swatch_attribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\Product',
      ),
    ),
    'Magento\\ImportExport\\Model\\Import' => 
    array (
      'catalogProductFlatIndexerImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Flat\\Plugin\\Import',
      ),
      'invalidatePriceIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Price\\Plugin\\Import',
      ),
      'invalidateStockIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Stock\\Plugin\\Import',
      ),
      'invalidateEavIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Eav\\Plugin\\Import',
      ),
      'invalidateProductCategoryIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Category\\Plugin\\Import',
      ),
      'invalidateCategoryProductIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Category\\Product\\Plugin\\Import',
      ),
      'reindex_after_import' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\ImportExport',
      ),
    ),
    'Magento\\Customer\\Model\\ResourceModel\\Visitor' => 
    array (
      'catalogLog' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\Log',
      ),
      'reportLog' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Reports\\Model\\Plugin\\Log',
      ),
    ),
    'Magento\\Catalog\\Model\\Category\\DataProvider' => 
    array (
      'set_page_layout_default_value' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\SetPageLayoutDefaultValue',
      ),
      'mageworxAddCategoryCustomAttributes' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'MageWorx\\SeoAll\\Plugin\\AddCategoryCustomAttributesPlugin',
      ),
      'category_ui_form_url_key_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\Catalog\\Block\\Adminhtml\\Category\\Tab\\Attributes',
      ),
      'google_optimizer_category_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GoogleOptimizer\\Model\\Plugin\\Catalog\\Category\\DataProvider',
      ),
      'mageworx_custom_canonical_category_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoBase\\Plugin\\CustomCanonicalFormUpdate\\AddToCategoryFormPlugin',
      ),
    ),
    'Magento\\Theme\\Block\\Html\\Topmenu' => 
    array (
      'catalogTopmenu' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Block\\Topmenu',
      ),
    ),
    'Magento\\Framework\\Mview\\View\\StateInterface' => 
    array (
      'setStatusForMview' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\MviewState',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Website' => 
    array (
      'invalidatePriceIndexerOnWebsite' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Price\\Plugin\\Website',
      ),
      'categoryProductWebsiteAfterDelete' => 
      array (
        'sortOrder' => 0,
        'instance' => '\\Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\Website',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Store' => 
    array (
      'storeViewResourceAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Flat\\Plugin\\StoreView',
      ),
      'catalogProductFlatIndexerStore' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Flat\\Plugin\\Store',
      ),
      'categoryStoreAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\StoreView',
      ),
      'productAttributesStoreViewSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Eav\\Plugin\\StoreView',
      ),
      'catalogsearchFulltextIndexerStoreView' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Store\\View',
      ),
      'store_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Store\\View',
      ),
      'update_cms_url_rewrites_after_store_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CmsUrlRewrite\\Plugin\\Cms\\Model\\Store\\View',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Group' => 
    array (
      'storeGroupResourceAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Flat\\Plugin\\StoreGroup',
      ),
      'catalogProductFlatIndexerStoreGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Flat\\Plugin\\StoreGroup',
      ),
      'categoryStoreGroupAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\StoreGroup',
      ),
      'storeGroupResourceAroundBeforeSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Indexer\\Stock\\Plugin\\StoreGroup',
      ),
      'catalogsearchFulltextIndexerStoreGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Store\\Group',
      ),
      'group_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Store\\Group',
      ),
    ),
    'Magento\\Customer\\Api\\GroupRepositoryInterface' => 
    array (
      'invalidatePriceIndexerOnCustomerGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Price\\Plugin\\CustomerGroup',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Attribute\\Set' => 
    array (
      'invalidateEavIndexerOnAttributeSetSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Eav\\Plugin\\AttributeSet',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\TypeTransitionManager' => 
    array (
      'downloadable_product_transition' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Downloadable\\Model\\Product\\TypeTransitionManager\\Plugin\\Downloadable',
      ),
      'configurable_product_transition' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\TypeTransitionManager\\Plugin\\Configurable',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Config\\Backend\\ShowOutOfStock' => 
    array (
      'showOutOfStockValueChanged' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\ShowOutOfStockConfig',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Config' => 
    array (
      'productListingAttributesCaching' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\ResourceModel\\Config',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Attribute\\Backend\\AbstractBackend' => 
    array (
      'attributeValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\Attribute\\Backend\\AttributeValidation',
      ),
      'ConfigurableProduct::skipValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Model\\Attribute\\Backend\\AttributeValidation',
      ),
    ),
    'Magento\\Sales\\Api\\OrderItemRepositoryInterface' => 
    array (
      'get_gift_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\OrderItemGet',
      ),
      'vertex_commodity_code_order_item_repository' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommodityCodeExtensionAttributeOrderItemRepository',
      ),
    ),
    'Magento\\Eav\\Model\\ResourceModel\\ReadSnapshot' => 
    array (
      'catalogReadSnapshot' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\ResourceModel\\ReadSnapshotPlugin',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Item\\ToOrderItem' => 
    array (
      'copy_quote_files_to_order' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\QuoteItemProductOption',
      ),
      'append_bundle_data_to_order' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Bundle\\Model\\Plugin\\QuoteItem',
      ),
      'gift_message_quote_item_conversion' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\QuoteItem',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper' => 
    array (
      'weeeAttributeOptionsProcess' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Weee\\Plugin\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\ProcessTaxAttribute',
      ),
      'vertex_custom_option_flex_field_after_save_initialization' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomOptionFlexFieldExtensionAttributeInitializer',
      ),
      'product_save_rewrites_history_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper',
      ),
      'Bundle' => 
      array (
        'sortOrder' => 60,
        'instance' => 'Magento\\Bundle\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\Bundle',
      ),
      'Downloadable' => 
      array (
        'sortOrder' => 70,
        'instance' => 'Magento\\Downloadable\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\Downloadable',
      ),
      'configurable' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\Configurable',
      ),
      'updateConfigurations' => 
      array (
        'sortOrder' => 60,
        'instance' => 'Magento\\ConfigurableProduct\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\UpdateConfigurations',
      ),
      'cleanConfigurationTmpImages' => 
      array (
        'sortOrder' => 999,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Product\\Initialization\\CleanConfigurationTmpImages',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Repository' => 
    array (
      'filterCustomAttribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\FilterCustomAttribute',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View' => 
    array (
      'quantityValidators' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Block\\Plugin\\ProductView',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Action' => 
    array (
      'ReindexUpdatedProducts' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\ReindexUpdatedProducts',
      ),
      'quoteProductMassChange' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Quote\\Model\\Product\\Plugin\\MarkQuotesRecollectMassDisabled',
      ),
      'catalogsearchFulltextMassAction' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Product\\Action',
      ),
      'invalidate_pagecache_after_update_product_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\Product\\Action\\UpdateAttributesFlushCache',
      ),
      'price_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Model\\Product\\Action',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute\\Save' => 
    array (
      'massAction' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Plugin\\MassUpdateProductAttribute',
      ),
      'Ddg_UpdateProductAttribute_MassActionPlugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CatalogProductAttributeSavePlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Category' => 
    array (
      'category_move_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Category\\Move',
      ),
      'category_delete_plugin' => 
      array (
        'sortOrder' => 0,
        'disabled' => true,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Category\\Remove',
      ),
      'update_url_path_for_different_stores' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Category\\UpdateUrlPath',
      ),
      'catalogsearchFulltextCategory' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Category',
      ),
      'mw_category_delete_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'MageWorx\\SeoRedirects\\Plugin\\CategoryPlugin',
      ),
      'fulltext_search_indexer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Model\\Plugin\\Category',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\StorageInterface' => 
    array (
      'storage_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Storage',
      ),
    ),
    'Magento\\CatalogUrlRewrite\\Model\\Storage\\DbStorage' => 
    array (
      'dynamic_storage_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\DynamicCategoryRewrites',
      ),
    ),
    'Magento\\Framework\\Search\\Request\\Config\\FilesystemReader' => 
    array (
      'productAttributesDynamicFields' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogGraphQl\\Plugin\\Search\\Request\\ConfigReader',
      ),
      'catalogSearchDynamicFields' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Search\\ReaderPlugin',
      ),
    ),
    'Magento\\Framework\\View\\Model\\Layout\\Merge' => 
    array (
      'widget-layout-update-plugin' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Widget\\Model\\ResourceModel\\Layout\\Plugin',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository' => 
    array (
      'multishipping_quote_repository' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Multishipping\\Plugin\\MultishippingQuoteRepository',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address' => 
    array (
      'mposc_convert_quote_address_to_customer_address' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address\\ConvertQuoteAddressToCustomerAddress',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product' => 
    array (
      'clean_quote_items_after_product_delete' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Quote\\Model\\Product\\Plugin\\RemoveQuoteItems',
      ),
      'update_quote_items_after_product_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Quote\\Model\\Product\\Plugin\\UpdateQuoteItems',
      ),
      'catalogsearchFulltextProduct' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Product',
      ),
      'vertex_commodity_code_product_resource_model' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommodityCodeExtensionAttributeProductResourceModelPlugin',
      ),
      'apply_catalog_rules_after_product_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Product\\Save\\ApplyRules',
      ),
      'reload_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Model\\ResourceModel\\Product',
      ),
      'cleanups_wishlist_item_after_product_delete' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Wishlist\\Plugin\\Model\\ResourceModel\\Product',
      ),
    ),
    'Magento\\MediaGallerySynchronizationApi\\Model\\ImportFilesComposite' => 
    array (
      'createMediaGalleryThumbnails' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryUi\\Plugin\\CreateThumbnails',
      ),
    ),
    'Magento\\Cms\\Model\\ResourceModel\\Page' => 
    array (
      'cms_url_rewrite_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CmsUrlRewrite\\Plugin\\Cms\\Model\\ResourceModel\\Page',
        'disabled' => true,
      ),
      'mw_cms_url_rewrite_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'MageWorx\\SeoRedirects\\Plugin\\CmsPagePlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Creditmemo' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\History' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Invoice' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintAction' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-order-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintAction',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintCreditmemo' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-creditmemo-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintCreditmemo',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintInvoice' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-invoice-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintInvoice',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintShipment' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-shipment-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintShipment',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Reorder' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Shipment' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\View' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order' => 
    array (
      'mageworx_ordersgrid_sync_order' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Invoice' => 
    array (
      'mageworx_ordersgrid_sync_order_invoice' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Shipment' => 
    array (
      'mageworx_ordersgrid_sync_order_shipment' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Handler\\Address' => 
    array (
      'addressUpdate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Model\\Order\\Invoice\\Plugin\\AddressUpdate',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Converter' => 
    array (
      'cron_backend_config_structure_converter_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Cron\\Model\\Backend\\Config\\Structure\\Converter',
      ),
    ),
    'Magento\\Framework\\App\\RouterInterface' => 
    array (
      'csp_aware_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Csp\\Plugin\\CspAwareControllerPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Backend\\Price' => 
    array (
      'bundle' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Bundle\\Model\\Plugin\\PriceBackend',
      ),
      'configurable' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Plugin\\PriceBackend',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Item' => 
    array (
      'bundle' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Bundle\\Model\\Sales\\Order\\Plugin\\Item',
      ),
    ),
    'Magento\\Integration\\Api\\IntegrationServiceInterface' => 
    array (
      'webapiIntegrationService' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Integration\\Model\\Plugin\\Integration',
      ),
    ),
    'Magento\\User\\Model\\User' => 
    array (
      'revokeTokensFromInactiveAdmins' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Integration\\Plugin\\Model\\AdminUser',
      ),
    ),
    'Magento\\Customer\\Model\\Customer' => 
    array (
      'revokeTokensFromInactiveCustomers' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Integration\\Plugin\\Model\\CustomerUser',
      ),
      'ddg_customer_sendNewAccountEmail_disabler' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CustomerPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\CartConfiguration' => 
    array (
      'Downloadable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Downloadable\\Model\\Product\\CartConfiguration\\Plugin\\Downloadable',
      ),
      'isProductConfigured' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\Product\\Cart\\Configuration\\Plugin\\Grouped',
      ),
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\CartConfiguration\\Plugin\\Configurable',
      ),
    ),
    'Magento\\Framework\\App\\FrontControllerInterface' => 
    array (
      'configHash' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Deploy\\Model\\Plugin\\ConfigChangeDetector',
      ),
      'default_store_setter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\FrontController\\Plugin\\DefaultStore',
      ),
    ),
    'Magento\\Framework\\View\\Result\\Page' => 
    array (
      'updateBodyClass' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Smartwave\\Porto\\Plugin\\UpdateBodyClass',
      ),
    ),
    'Magento\\Checkout\\Block\\Cart\\LayoutProcessor' => 
    array (
      'checkout_cart_shipping_dhl' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Dhl\\Model\\Plugin\\Checkout\\Block\\Cart\\Shipping',
      ),
      'checkout_cart_shipping_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\OfflineShipping\\Model\\Plugin\\Checkout\\Block\\Cart\\Shipping',
      ),
    ),
    'Magento\\Customer\\Controller\\Ajax\\Login' => 
    array (
      'captcha_validation' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Captcha\\Model\\Customer\\Plugin\\AjaxLogin',
      ),
    ),
    'Magento\\Checkout\\Block\\Cart\\Sidebar' => 
    array (
      'login_captcha' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Captcha\\Model\\Cart\\ConfigPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Product\\Category\\Action\\Rows' => 
    array (
      'catalogsearchFulltextCategoryAssignment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Product\\Category\\Action\\Rows',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute' => 
    array (
      'catalogsearchFulltextIndexerAttribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Attribute',
      ),
      'catalogsearchAttributeSearchWeightCache' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Attribute\\SearchWeight',
      ),
      'updateElasticsearchIndexerMapping' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Elasticsearch\\Model\\Indexer\\Fulltext\\Plugin\\Category\\Product\\Attribute',
      ),
      'invalidate_pagecache_after_attribute_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\ResourceModel\\Attribute\\Save',
      ),
    ),
    'Magento\\Catalog\\Model\\Layer\\Search\\CollectionFilter' => 
    array (
      'searchQuery' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Layer\\Search\\Plugin\\CollectionFilter',
      ),
    ),
    'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Action\\DataProvider' => 
    array (
      'stockedProductsFilterPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Plugin\\StockedProductsFilterPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Action\\Rows' => 
    array (
      'catalogsearchFulltextProductAssignment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Elasticsearch\\Model\\Indexer\\Fulltext\\Plugin\\Category\\Product\\Action\\Rows',
      ),
    ),
    'Magento\\Framework\\Indexer\\Config\\DependencyInfoProvider' => 
    array (
      'indexerDependencyUpdaterPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Elasticsearch\\Model\\Indexer\\Plugin\\DependencyUpdaterPlugin',
      ),
    ),
    'Magento\\Email\\Model\\Template' => 
    array (
      'dotmailer_template_plugin' => 
      array (
        'sortOrder' => 100,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\TemplatePlugin',
      ),
    ),
    'Magento\\Framework\\Mail\\TransportInterface' => 
    array (
      'WindowsSmtpConfig' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Email\\Model\\Plugin\\WindowsSmtpConfig',
      ),
      'EmailDisable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Email\\Model\\Mail\\TransportInterfacePlugin',
      ),
      'ddg_mail_transport' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\TransportPlugin',
      ),
      'mageplaza_mail_transport' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Mageplaza\\Smtp\\Mail\\Transport',
      ),
    ),
    'Magento\\Shipping\\Block\\DataProviders\\Tracking\\DeliveryDateTitle' => 
    array (
      'update_delivery_date_title' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Fedex\\Plugin\\Block\\DataProviders\\Tracking\\ChangeTitle',
      ),
      'ups_update_delivery_date_title' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Ups\\Plugin\\Block\\DataProviders\\Tracking\\ChangeTitle',
      ),
    ),
    'Magento\\Shipping\\Block\\Tracking\\Popup' => 
    array (
      'update_delivery_date_value' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Fedex\\Plugin\\Block\\Tracking\\PopupDeliveryDate',
      ),
    ),
    'Magento\\Sales\\Api\\OrderRepositoryInterface' => 
    array (
      'save_gift_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\OrderSave',
      ),
      'get_gift_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\OrderGet',
      ),
      'save_order_tax' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Model\\Plugin\\OrderSave',
      ),
      'mageworx_order_base_save_device_data' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrdersBase\\Plugin\\Order\\SaveAttributes',
      ),
      'mageworx_order_base_get_device_data' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrdersBase\\Plugin\\Order\\GetAttributes',
      ),
      'mposc_add_order_comment_to_order_api' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Api\\OrderComment',
      ),
      'get_vertex_order_item_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\OrderRepositoryPlugin',
      ),
      'vertex_commodity_code_order_item_order_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\AddCommodityCodeToOrderItemPlugin',
      ),
      'addVertexCustomerCountryToOrderAddress' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\AddCustomerCountryToOrderAddressPlugin',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Identifier' => 
    array (
      'core-app-area-design-exception-plugin' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\PageCache\\Model\\App\\CacheIdentifierPlugin',
      ),
      'mplayerPagecacheIdentifier' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\LayeredNavigation\\Plugin\\PageCache\\Identifier',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Cache' => 
    array (
      'fpc-type-plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\PageCache\\Model\\App\\PageCachePlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Type' => 
    array (
      'grouped_output' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\Product\\Type\\Plugin',
      ),
      'configurable_output' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\Type\\Plugin',
      ),
    ),
    'Magento\\Catalog\\Helper\\Product\\Configuration' => 
    array (
      'grouped_options' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Helper\\Product\\Configuration\\Plugin\\Grouped',
      ),
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Helper\\Product\\Configuration\\Plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Initialization\\Helper\\ProductLinks' => 
    array (
      'GroupedProduct' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\Product\\Initialization\\Helper\\ProductLinks\\Plugin\\Grouped',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Link' => 
    array (
      'groupedProductLinkProcessor' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\ResourceModel\\Product\\Link\\RelationPersister',
      ),
    ),
    'Magento\\GroupedProduct\\Model\\Product\\Type\\Grouped' => 
    array (
      'outOfStockFilter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedCatalogInventory\\Plugin\\OutOfStockFilter',
      ),
      'grouped_product_minimum_advertised_price' => 
      array (
        'sortOrder' => 0,
        'instance' => '\\Magento\\MsrpGroupedProduct\\Plugin\\Model\\Product\\Type\\Grouped',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Quote\\Item\\QuantityValidator\\Initializer\\Option' => 
    array (
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Quote\\Item\\QuantityValidator\\Initializer\\Option\\Plugin\\ConfigurableProduct',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Admin\\Item' => 
    array (
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Order\\Admin\\Item\\Plugin\\Configurable',
      ),
    ),
    'Magento\\Catalog\\Model\\Entity\\Product\\Attribute\\Group\\AttributeMapperInterface' => 
    array (
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Entity\\Product\\Attribute\\Group\\AttributeMapper\\Plugin',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductRepositoryInterface' => 
    array (
      'configurableProductSaveOptions' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Plugin\\ProductRepositorySave',
      ),
      'vertex_commodity_code_product_repository' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommodityCodeExtensionAttributeProductRepositoryPlugin',
      ),
    ),
    'Magento\\ProductVideo\\Block\\Product\\View\\Gallery' => 
    array (
      'product_video_gallery' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Block\\Plugin\\Product\\Media\\Gallery',
      ),
    ),
    'Magento\\ConfigurableProduct\\Model\\Product\\Type\\Configurable' => 
    array (
      'add_swatch_attributes_to_configurable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\Configurable',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Pricing\\Renderer\\SalableResolver' => 
    array (
      'configurable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Catalog\\Model\\Product\\Pricing\\Renderer\\SalableResolver',
      ),
    ),
    'Magento\\SalesRule\\Model\\Rule\\Condition\\Product' => 
    array (
      'apply_rule_on_configurable_children' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\SalesRule\\Model\\Rule\\Condition\\Product',
      ),
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector' => 
    array (
      'apply_tax_class_id' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector',
      ),
      'vertexItemLevelMap' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommonTaxCollectorPlugin',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Backend\\Baseurl' => 
    array (
      'updateAnalyticsSubscription' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Analytics\\Model\\Plugin\\BaseUrlConfigPlugin',
      ),
    ),
    'Magento\\Quote\\Model\\Cart\\CartTotalRepository' => 
    array (
      'multishipping_shipping_addresses' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Multishipping\\Model\\Cart\\CartTotalRepositoryPlugin',
      ),
      'coupon_label_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesRule\\Plugin\\CartTotalRepository',
      ),
    ),
    'Magento\\Integration\\Model\\ConfigBasedIntegrationManager' => 
    array (
      'webapiSetup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Webapi\\Model\\Plugin\\Manager',
      ),
    ),
    'Magento\\Backend\\Model\\Auth' => 
    array (
      'login_as_customer_admin_logout' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomer\\Plugin\\AdminLogoutPlugin',
      ),
      'security_admin_sessions_login' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\Auth',
      ),
    ),
    'Magento\\Framework\\Api\\DataObjectHelper' => 
    array (
      'add_allow_remote_shopping_assistance_to_customer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerGraphQl\\Plugin\\DataObjectHelperPlugin',
      ),
    ),
    'Magento\\LoginAsCustomerApi\\Api\\AuthenticateCustomerBySecretInterface' => 
    array (
      'process_shopping_cart' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerQuote\\Plugin\\LoginAsCustomerApi\\ProcessShoppingCartPlugin',
      ),
    ),
    'Magento\\MediaGalleryApi\\Api\\DeleteAssetsByPathsInterface' => 
    array (
      'remove_media_content_after_asset_is_removed_by_path' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaContent\\Plugin\\MediaGalleryAssetDeleteByPath',
      ),
      'delete_renditions_on_assets_delete' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\RemoveRenditions',
      ),
    ),
    'Magento\\MediaGalleryApi\\Api\\DeleteDirectoriesByPathsInterface' => 
    array (
      'remove_media_content_after_asset_is_removed_by_directory_path' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaContent\\Plugin\\MediaGalleryAssetDeleteByDirectoryPath',
      ),
    ),
    'Magento\\MediaGallerySynchronization\\Model\\Consume' => 
    array (
      'synchronize_media_content' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaContentSynchronization\\Plugin\\SynchronizeMediaContent',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\Processor' => 
    array (
      'media_gallery_image_remove_metadata' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryCatalog\\Plugin\\Product\\Gallery\\RemoveAssetAfterRemoveImage',
      ),
    ),
    'Magento\\Cms\\Model\\Wysiwyg\\Images\\GetInsertImageContent' => 
    array (
      'set_rendition_path' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\SetRenditionPath',
      ),
    ),
    'Magento\\MediaGallerySynchronizationApi\\Model\\CreateAssetFromFileInterface' => 
    array (
      'addMetadataToAssetCreatedFromFile' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGallerySynchronizationMetadata\\Plugin\\CreateAssetFromFileMetadata',
      ),
    ),
    'Magento\\Framework\\App\\MaintenanceMode' => 
    array (
      'amqp_maintenance_mode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MessageQueue\\Model\\Plugin\\ResourceModel\\Lock',
      ),
    ),
    'Magento\\ConfigurableProduct\\Model\\ResourceModel\\Product\\Type\\Configurable\\Product\\Collection' => 
    array (
      'catalogRulePriceForConfigurableProduct' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\ConfigurableProduct\\Model\\ResourceModel\\AddCatalogRulePrice',
      ),
    ),
    'Magento\\Framework\\App\\Http' => 
    array (
      'framework-http-newrelic' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\HttpPlugin',
      ),
    ),
    'Magento\\Framework\\App\\State' => 
    array (
      'framework-state-newrelic' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\StatePlugin',
      ),
    ),
    'Symfony\\Component\\Console\\Command\\Command' => 
    array (
      'newrelic-describe-commands' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\CommandPlugin',
      ),
    ),
    'Magento\\Framework\\Profiler\\Driver\\Standard\\Stat' => 
    array (
      'newrelic-describe-cronjobs' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\StatPlugin',
      ),
    ),
    'Magento\\Newsletter\\Model\\Subscriber' => 
    array (
      'ddg_newsletter_disabler' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\SubscriberPlugin',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteManagement' => 
    array (
      'validate_purchase_order_number' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\OfflinePayments\\Plugin\\ValidatePurchaseOrderNumber',
      ),
      'coupon_uses_increment_plugin' => 
      array (
        'sortOrder' => 20,
        'instance' => 'Magento\\SalesRule\\Plugin\\CouponUsagesIncrement',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Config' => 
    array (
      'append_sales_rule_keys_to_quote' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesRule\\Model\\Plugin\\QuoteConfigProductAttributes',
      ),
    ),
    'Magento\\Sales\\Model\\Service\\OrderService' => 
    array (
      'coupon_uses_decrement_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesRule\\Plugin\\CouponUsagesDecrement',
      ),
    ),
    'Magento\\Sales\\Api\\Data\\OrderPaymentInterface' => 
    array (
      'PaymentVaultExtensionAttributeOperations' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Vault\\Plugin\\PaymentVaultAttributesLoad',
      ),
    ),
    'Magento\\Checkout\\Api\\PaymentInformationManagementInterface' => 
    array (
      'ProcessPaymentVaultInformationManagement' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Vault\\Plugin\\PaymentVaultInformationManagement',
      ),
      'validate-agreements' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CheckoutAgreements\\Model\\Checkout\\Plugin\\Validation',
      ),
    ),
    'Magento\\Payment\\Model\\Checks\\Composite' => 
    array (
      'paypal_specification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Model\\Method\\Checks\\SpecificationPlugin',
      ),
    ),
    'Magento\\Sales\\Model\\Order' => 
    array (
      'express_order_invoice' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\OrderCanInvoice',
      ),
      'admin-order-placement-comment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerSales\\Plugin\\AdminAddCommentOnOrderPlacementPlugin',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\CanInvoice' => 
    array (
      'express_order_invoice' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\ValidatorCanInvoice',
      ),
    ),
    'Magento\\Framework\\Session\\SessionStartChecker' => 
    array (
      'transparent_session_checker' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\TransparentSessionChecker',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Payment' => 
    array (
      'paypal_transparent' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\TransparentOrderPayment',
      ),
      'amazon_pay_order_payment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Amazon\\Payment\\Plugin\\OrderCurrencyComment',
      ),
    ),
    'Magento\\Quote\\Model\\AddressAdditionalDataProcessor' => 
    array (
      'persistent_remember_me_checkbox_processor' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Persistent\\Model\\Checkout\\AddressDataProcessorPlugin',
      ),
    ),
    'Magento\\Customer\\CustomerData\\Customer' => 
    array (
      'section_data' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Persistent\\Model\\Plugin\\CustomerData',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\CreateHandler' => 
    array (
      'external_video_media_entry_saver' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ProductVideo\\Model\\Plugin\\Catalog\\Product\\Gallery\\CreateHandler',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\ReadHandler' => 
    array (
      'external_video_media_entry_reader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ProductVideo\\Model\\Plugin\\Catalog\\Product\\Gallery\\ReadHandler',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Gallery' => 
    array (
      'external_video_media_resource_backend' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ProductVideo\\Model\\Plugin\\ExternalVideoResourceBackend',
      ),
    ),
    'Magento\\Checkout\\Api\\GuestPaymentInformationManagementInterface' => 
    array (
      'validate-guest-agreements' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CheckoutAgreements\\Model\\Checkout\\Plugin\\GuestValidation',
      ),
      'guest_payment_no_commit_after_event_workaround' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\GuestPaymentInformationManagementPlugin',
      ),
    ),
    'Magento\\Framework\\View\\Asset\\MergeService' => 
    array (
      'cleanMergedJsCss' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaStorage\\Model\\Asset\\Plugin\\CleanMergedJsCss',
      ),
    ),
    'Magento\\Sales\\Model\\RefundOrder' => 
    array (
      'refundOrderAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\ReturnToStockOrder',
      ),
    ),
    'Magento\\Sales\\Model\\RefundInvoice' => 
    array (
      'refundInvoiceAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\ReturnToStockInvoice',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\RefundOrderInterface' => 
    array (
      'refundOrderValidationAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\Validation\\OrderRefundCreationArguments',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\RefundInvoiceInterface' => 
    array (
      'refundInvoiceValidationAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\Validation\\InvoiceRefundCreationArguments',
      ),
    ),
    'Magento\\MediaStorage\\Model\\File\\Storage\\Synchronization' => 
    array (
      'remoteMedia' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\RemoteStorage\\Plugin\\MediaStorage',
      ),
    ),
    'Magento\\Framework\\Image\\Adapter\\AbstractAdapter' => 
    array (
      'remoteImageFile' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\RemoteStorage\\Plugin\\Image',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Eav\\Attribute' => 
    array (
      'save_swatches_option_params' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\EavAttribute',
      ),
      'change_product_attribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Product\\Attribute',
      ),
      'invalidate_caches_after_attribute_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Plugin\\Catalog\\CacheInvalidate',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\AbstractProduct' => 
    array (
      'add_product_object_to_image_data_array' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\ProductImage',
      ),
    ),
    'Magento\\LayeredNavigation\\Block\\Navigation\\FilterRenderer' => 
    array (
      'swatches_layered_renderer' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\FilterRenderer',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\OptionManagement' => 
    array (
      'swatches_product_attribute_optionmanagement_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Plugin\\Eav\\Model\\Entity\\Attribute\\OptionManagement',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\ToOrder' => 
    array (
      'add_tax_to_order' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Model\\Quote\\ToOrderConverter',
      ),
    ),
    'Magento\\Quote\\Model\\Cart\\TotalsConverter' => 
    array (
      'add_tax_details' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Model\\Quote\\GrandTotalDetailsPlugin',
      ),
      'addGiftWrapInitialAmount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote\\GiftWrap',
      ),
      'vertex_calculation_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\TotalsCalculationMessagePlugin',
      ),
    ),
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Listing\\DataProvider' => 
    array (
      'taxSettingsProvider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Plugin\\Ui\\DataProvider\\TaxSettings',
      ),
      'weeeSettingsProvider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Weee\\Plugin\\Ui\\DataProvider\\WeeeSettings',
      ),
      'wishlistSettingsDataProvider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Wishlist\\Plugin\\Ui\\DataProvider\\WishlistSettings',
      ),
    ),
    'Magento\\Webapi\\Model\\ServiceMetadata' => 
    array (
      'webapiServiceMetadataAsync' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiAsync\\Plugin\\ServiceMetadata',
      ),
    ),
    'Magento\\Webapi\\Model\\Cache\\Type\\Webapi' => 
    array (
      'webapiCacheAsync' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiAsync\\Plugin\\Cache\\Webapi',
      ),
    ),
    'Magento\\Webapi\\Controller\\Rest' => 
    array (
      'webapiContorllerRestAsync' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiAsync\\Plugin\\ControllerRest',
      ),
    ),
    'Magento\\Webapi\\Model\\Config\\Converter' => 
    array (
      'webapiResourceSecurity' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiSecurity\\Model\\Plugin\\AnonymousResourceSecurity',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute\\RemoveProductAttributeData' => 
    array (
      'removeWeeAttributesData' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Weee\\Plugin\\Catalog\\ResourceModel\\Attribute\\RemoveProductWeeData',
      ),
    ),
    'Magento\\Wishlist\\Controller\\AbstractIndex' => 
    array (
      'authentication' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Wishlist\\Controller\\Index\\Plugin',
      ),
    ),
    'Magento\\Checkout\\CustomerData\\Cart' => 
    array (
      'amazon_core_cart_section' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Amazon\\Core\\Plugin\\CartSection',
      ),
    ),
    'Magento\\Checkout\\Controller\\Cart\\Index' => 
    array (
      'amazon_login_cart_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CartController',
      ),
    ),
    'Magento\\Checkout\\Controller\\Index\\Index' => 
    array (
      'amazon_login_checkout_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CheckoutController',
      ),
    ),
    'Magento\\Customer\\Controller\\Account\\Login' => 
    array (
      'amazon_login_login_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\LoginController',
      ),
    ),
    'Magento\\Customer\\Controller\\Account\\Create' => 
    array (
      'amazon_login_create_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CreateController',
      ),
    ),
    'Magento\\Sales\\Api\\OrderCustomerManagementInterface' => 
    array (
      'amazon_login_order_customer_service' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\OrderCustomerManagement',
      ),
      'Ddg_CustomerManagementPlugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CustomerManagementPlugin',
      ),
    ),
    'Magento\\Quote\\Api\\CartRepositoryInterface' => 
    array (
      'amazon_payment_quote_repository' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\QuoteRepository',
      ),
      'mageworx_order_editor_add_edit_in_progress_extension_attribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Quote\\AddEditInProgressExtensionAttributeToQuote',
      ),
    ),
    'Magento\\Checkout\\Api\\ShippingInformationManagementInterface' => 
    array (
      'amazon_payment_shipping_information_management' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\ShippingInformationManagement',
      ),
    ),
    'Magento\\Quote\\Api\\Data\\PaymentInterface' => 
    array (
      'amazon_payment_additional_information' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Amazon\\Payment\\Plugin\\AdditionalInformation',
      ),
    ),
    'Amazon\\Payment\\Model\\Method\\AmazonLoginMethod' => 
    array (
      'disable_amazon_payment_method' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'Amazon\\Payment\\Plugin\\DisableAmazonPaymentMethod',
      ),
    ),
    'Magento\\Quote\\Model\\PaymentMethodManagement' => 
    array (
      'confirm_order_reference_on_payment_details_save' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'Amazon\\Payment\\Plugin\\ConfirmOrderReference',
      ),
    ),
    'Magento\\Framework\\Webapi\\ErrorProcessor' => 
    array (
      'amazon_payment_webapi_error_processor' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\WebapiErrorProcessor',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Subscriber\\NewAction' => 
    array (
      'ddg_newsletter_email_capture' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\NewsletterEmailCapturePlugin',
      ),
    ),
    'Magento\\Customer\\Model\\EmailNotificationInterface' => 
    array (
      'ddg_customer_email_disabler' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CustomerEmailNotificationPlugin',
      ),
    ),
    'Magento\\Reports\\Model\\ResourceModel\\Product\\Collection' => 
    array (
      'ddg_reports_product_collection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\ReportsProductCollectionPlugin',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilder' => 
    array (
      'Ddg_TransportBuilderPlugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\TransportBuilderPlugin',
      ),
      'mageplaza_mail_template_transport_builder' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Mageplaza\\Smtp\\Mail\\Template\\TransportBuilder',
      ),
      'magetrend-pdf-transport-builder' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\Template\\TransportBuilder',
      ),
    ),
    'Magento\\Framework\\Mail\\MessageInterface' => 
    array (
      'dotmailer_message_plugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\MessagePlugin',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Manage\\Index' => 
    array (
      'dotmailer_newsletter_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\NewsletterManageIndexPlugin',
      ),
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite\\Save' => 
    array (
      'dotmailer_url_rewrite_save_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\UrlRewriteSavePlugin',
      ),
    ),
    'Magento\\SalesRule\\Api\\CouponRepositoryInterface' => 
    array (
      'coupon_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CouponPlugin',
      ),
    ),
    'Magento\\SalesRule\\Model\\ResourceModel\\Coupon\\Collection' => 
    array (
      'ddg_generated_for_email_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CouponCollectionPlugin',
      ),
    ),
    'Magento\\SalesRule\\Model\\Utility' => 
    array (
      'ddg_coupon_expired_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CouponExpiredPlugin',
      ),
    ),
    'Magento\\CatalogInventory\\Api\\StockRegistryInterface' => 
    array (
      'ddg_stock_update_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\StockUpdatePlugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Controller\\Ajax\\Emailcapture' => 
    array (
      'ddg_chat_emailcapture_plugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Chat\\Plugin\\EmailcapturePlugin',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\Save' => 
    array (
      'ddg_new_shipment_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\Order\\Shipment\\NewShipmentPlugin',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\AddTrack' => 
    array (
      'ddg_update_shipment_plugin' => 
      array (
        'sortOrder' => 3,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\Order\\Shipment\\ShipmentUpdatePlugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Model\\Cron\\Cleaner' => 
    array (
      'ddg_sms_cron_cleaner_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\CronCleanerPlugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Console\\Command\\Provider\\TaskProvider' => 
    array (
      'ddg_sms_task_provider_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\TaskProviderPlugin',
      ),
    ),
    'Magento\\Checkout\\Block\\Checkout\\LayoutProcessor' => 
    array (
      'ddg_sms_international_telephone_layout_processor_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\Block\\Checkout\\LayoutProcessor',
      ),
    ),
    'Klarna\\Core\\Helper\\KlarnaConfig' => 
    array (
      'klarnaKpKlarnaConfig' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Klarna\\Kp\\Plugin\\Helper\\KlarnaConfigPlugin',
      ),
    ),
    'Klarna\\Core\\Model\\Checkout\\Orderline\\Collector' => 
    array (
      'klarnaKpCollector' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Klarna\\Kp\\Plugin\\Model\\Checkout\\Orderline\\CollectorPlugin',
      ),
    ),
    'Magento\\Payment\\Helper\\Data' => 
    array (
      'klarnaKpPaymentData' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Klarna\\Kp\\Plugin\\Payment\\Helper\\DataPlugin',
      ),
    ),
    'Klarna\\Core\\Model\\Config' => 
    array (
      'klarnaKpConfig' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Klarna\\Kp\\Plugin\\Model\\ConfigPlugin',
      ),
    ),
    'Magento\\QuoteGraphQl\\Model\\Cart\\Payment\\AdditionalDataProviderPool' => 
    array (
      'klarnaKpGraphQlAdditionalDataProviderPool' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Klarna\\KpGraphQl\\Plugin\\Model\\Cart\\Payment\\AdditionalDataProviderPoolPlugin',
      ),
    ),
    'Magento\\QuoteGraphQl\\Model\\Resolver\\AvailablePaymentMethods' => 
    array (
      'klarnaKpGraphQlAvailablePaymentMethods' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Klarna\\KpGraphQl\\Plugin\\Model\\Resolver\\AvailablePaymentMethodsPlugin',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Items\\Renderer\\DefaultRenderer' => 
    array (
      'mageworx_order_editor_update_default_item_renderer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Block\\Sales\\Adminhtml\\Order\\View\\Items\\DefaultRenderer',
      ),
    ),
    'Magento\\Bundle\\Block\\Adminhtml\\Sales\\Order\\View\\Items\\Renderer' => 
    array (
      'mageworx_order_editor_update_bundle_item_renderer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Block\\Sales\\Adminhtml\\Order\\View\\Items\\BundleRenderer',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Shipment\\Track' => 
    array (
      'mageworx_ordersgrid_sync_order_shipment_track' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Address' => 
    array (
      'mageworx_ordersgrid_sync_order_address' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Item' => 
    array (
      'mageworx_ordersgrid_sync_order_item' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Tax' => 
    array (
      'mageworx_ordersgrid_sync_order_tax' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\CatalogUrlRewrite\\Observer\\ProductProcessUrlRewriteRemovingObserver' => 
    array (
      'mw_product_delete_plugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'MageWorx\\SeoRedirects\\Plugin\\ProductProcessUrlRewriteRemovingObserverPlugin',
      ),
    ),
    'Magento\\Sitemap\\Model\\Observer' => 
    array (
      'aroundScheduledGenerateSitemaps' => 
      array (
        'sortOrder' => 1,
        'instance' => 'MageWorx\\XmlSitemap\\Plugin\\CronGenerateSitemap',
      ),
    ),
    'Magento\\Framework\\Data\\Form\\Element\\Factory' => 
    array (
      'md_base_form_additional_elements' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Base\\Plugin\\Magento\\Framework\\Data\\Form\\Element\\Factory',
      ),
    ),
    'Magento\\Checkout\\Model\\ShippingInformationManagement' => 
    array (
      'mpdt_saveDeliveryInformation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\DeliveryTime\\Model\\Plugin\\Checkout\\ShippingInformationManagement',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Kernel' => 
    array (
      'mplayerProcessRequest' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\LayeredNavigation\\Plugin\\PageCache\\ProcessRequest',
      ),
    ),
    'Magento\\Customer\\Model\\Address' => 
    array (
      'setShouldIgnoreValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address',
      ),
    ),
    'Magento\\Checkout\\Model\\TotalsInformationManagement' => 
    array (
      'saveShipingMethodOnCalculate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Checkout\\TotalsInformationManagement',
      ),
    ),
    'Magento\\Quote\\Model\\Quote' => 
    array (
      'getItemById_Osc' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote',
      ),
    ),
    'Magento\\Checkout\\Helper\\Data' => 
    array (
      'osc_allow_guest_checkout' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Checkout\\Data',
      ),
    ),
    'Magento\\Eav\\Model\\Attribute\\Data\\AbstractData' => 
    array (
      'mposc_bypass_validate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Eav\\Model\\Attribute\\AbstractData',
      ),
    ),
    'Magento\\Customer\\Model\\Attribute\\Data\\Postcode' => 
    array (
      'mposc_bypass_validate_postcode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Eav\\Model\\Attribute\\Postcode',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteValidator' => 
    array (
      'mposc_set_should_ignore_validation_quote' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote\\QuoteValidator',
      ),
    ),
    'Magento\\Bundle\\Block\\Catalog\\Product\\View\\Type\\Bundle\\Option' => 
    array (
      'mposc_append_item_option' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Catalog\\Product\\View\\Type\\Bundle\\OptionPlugin',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Options\\AbstractOptions' => 
    array (
      'mposc_append_item_layout' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Catalog\\Product\\View\\Options\\AbstractOptions',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\ToOrderAddress' => 
    array (
      'mposc_convert_quote_address_to_order_address' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address\\ConvertQuoteAddressToOrderAddress',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\CustomAttributeList' => 
    array (
      'mposc_add_custom_field_to_address' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote\\Address\\CustomAttributeList',
      ),
    ),
    'Magento\\Customer\\Model\\Address\\CustomAttributeList' => 
    array (
      'mposc_add_custom_field_to_customer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address\\CustomAttributeList',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilderByStore' => 
    array (
      'mpsmtp_appTransportBuilder' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Smtp\\Plugin\\Message',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Invoice' => 
    array (
      'magetrend-invoice-pdf' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Invoice',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Creditmemo' => 
    array (
      'magetrend-creditmemo-pdf' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Creditmemo',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Shipment' => 
    array (
      'magetrend-shipment-pdf' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Shipment',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintAction' => 
    array (
      'magetrend-guest-order-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintAction',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintInvoice' => 
    array (
      'magetrend-guest-invoice-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintInvoice',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintCreditmemo' => 
    array (
      'magetrend-guest-creditmemo-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintCreditmemo',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintShipment' => 
    array (
      'magetrend-guest-shipment-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintShipment',
      ),
    ),
    'Magento\\Framework\\Mail\\TransportInterfaceFactory' => 
    array (
      'magetrend-pdf-transport-interface' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\TransportInterfaceFactory',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Total\\DefaultTotal' => 
    array (
      'magetrend-pdf-default-total' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Total\\DefaultTotal',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\Pdfinvoices' => 
    array (
      'magetrend-pdf-mass-pdf-invoice-list' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractInvoice\\Pdfinvoices',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\PrintAction' => 
    array (
      'magetrend-pdf-mass-pdf-invoice' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractInvoice\\PrintAction',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\Pdfshipments' => 
    array (
      'magetrend-pdf-mass-pdf-shipment-list' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractShipment\\Pdfshipments',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\PrintAction' => 
    array (
      'magetrend-pdf-mass-pdf-shipment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractShipment\\PrintAction',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\Pdfcreditmemos' => 
    array (
      'magetrend-pdf-mass-pdf-creditmemo-list' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractCreditmemo\\Pdfcreditmemos',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\PrintAction' => 
    array (
      'magetrend-pdf-mass-pdf-creditmemo' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractCreditmemo\\PrintAction',
      ),
    ),
    'Magento\\Framework\\Mail\\Message' => 
    array (
      'magetrend-pdf-message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\Message',
      ),
    ),
    'Magento\\Framework\\Mail\\MimeMessage' => 
    array (
      'magetrend-pdf-mime-message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\MimeMessage',
      ),
    ),
    'Magento\\MediaGalleryIntegration\\Plugin\\SaveImageInformation' => 
    array (
      'magetrend-241-bugfix' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\MediaGalleryIntegration\\Plugin\\SaveImageInformation',
      ),
    ),
    'Magento\\Framework\\App\\Request\\CsrfValidator' => 
    array (
      'csrf_validator_skip_psigate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'PL\\Psigate\\Plugin\\CsrfValidatorSkip',
      ),
    ),
    'Magento\\Framework\\View\\Asset\\Minification' => 
    array (
      'braintreeExcludeFromMinification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'PayPal\\Braintree\\Plugin\\ExcludeFromMinification',
      ),
    ),
    'Magento\\Catalog\\Pricing\\Render\\FinalPriceBox' => 
    array (
      'Sw_Dailydeals_change_template' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Smartwave\\Dailydeals\\Plugin\\FinalPricePlugin',
      ),
    ),
    'Vertex\\Utility\\SoapClientFactory' => 
    array (
      'registerLastCreatedClient' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\SoapClientFactoryPlugin',
      ),
    ),
    'Vertex\\Utility\\ServiceActionPerformerFactory' => 
    array (
      'useObjectManager' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\ServiceActionPerformerFactoryPlugin',
      ),
    ),
    'Magento\\Sales\\Api\\OrderAddressRepositoryInterface' => 
    array (
      'extensionAttributeVertexVatCountryCode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\VatCountryCodeAttributePlugin',
      ),
    ),
    'Magento\\Tax\\Api\\TaxCalculationInterface' => 
    array (
      'vertexTaxCalculation' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\TaxCalculationPlugin',
      ),
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax' => 
    array (
      'vertexOrderLevelMap' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\TaxPlugin',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface' => 
    array (
      'vertex_custom_option_flex_field_db_handler' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomOptionFlexFieldExtensionAttributeHandler',
      ),
    ),
    'Magento\\Sales\\Api\\CreditmemoRepositoryInterface' => 
    array (
      'get_vertex_creditmemo_item_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CreditmemoRepositoryPlugin',
      ),
    ),
    'Magento\\Sales\\Api\\InvoiceRepositoryInterface' => 
    array (
      'get_vertex_invoice_item_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\InvoiceRepositoryPlugin',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\ListProduct' => 
    array (
      'yotpo_yotpo_catalog_block_product_listproduct_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Catalog\\Block\\Product\\ListProduct',
      ),
    ),
    'Magento\\Review\\Block\\Product\\ReviewRenderer' => 
    array (
      'yotpo_yotpo_review_block_product_reviewrenderer_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Review\\Block\\Product\\ReviewRenderer',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Details' => 
    array (
      'yotpo_yotpo_catalog_block_product_view_details_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Catalog\\Block\\Product\\View\\Details',
      ),
    ),
    'Magento\\Backend\\App\\AbstractAction' => 
    array (
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Backend\\Model\\Auth\\Session' => 
    array (
      'security_admin_sessions_prolong' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\AuthSession',
      ),
    ),
    'Magento\\Framework\\App\\Action\\Action' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'disabled' => true,
      ),
    ),
    'Magento\\Eav\\Model\\Adminhtml\\System\\Config\\Source\\Inputtype' => 
    array (
      'append_compatible_input_types' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Plugin\\Eav\\System\\Config\\Source\\InputtypePlugin',
      ),
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth\\Login' => 
    array (
      'security_login_form' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\LoginController',
      ),
    ),
    'Magento\\User\\Model\\UserValidationRules' => 
    array (
      'user_expiration_validator' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\UserValidationRules',
      ),
    ),
    'Magento\\User\\Block\\User\\Edit\\Tab\\Main' => 
    array (
      'user_expiration_user_form_field' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\AdminUserForm',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Action\\Full' => 
    array (
      'invalidate_pagecache_after_full_reindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\Indexer\\Category\\Product\\Execute',
      ),
    ),
    'Magento\\Eav\\Api\\AttributeSetRepositoryInterface' => 
    array (
      'remove_products' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\AttributeSetRepository\\RemoveProducts',
      ),
    ),
    'Magento\\Catalog\\Model\\ProductLink\\Search' => 
    array (
      'processOutOfStockProducts' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\ProductSearch',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Rule' => 
    array (
      'addVariationsToProductRule' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\CatalogRule\\Model\\Rule\\ConfigurableProductHandler',
      ),
      'configurableChildValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\CatalogRule\\Model\\Rule\\Validation',
      ),
    ),
    'Magento\\Catalog\\Model\\Category' => 
    array (
      'apply_after_products_assign' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Category',
      ),
    ),
    'Magento\\Customer\\Model\\Group' => 
    array (
      'reindex_after_delete_customer_group' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\CustomerGroup',
      ),
    ),
    'Magento\\Catalog\\Block\\Adminhtml\\Product\\Edit\\Tab\\Attributes' => 
    array (
      'product_form_url_key_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\Catalog\\Block\\Adminhtml\\Product\\Edit\\Tab\\Attributes',
      ),
    ),
    'Magento\\Bundle\\Block\\Adminhtml\\Catalog\\Product\\Edit\\Tab\\Attributes' => 
    array (
      'bundle_msrp_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Msrp\\Plugin\\Bundle\\Block\\Adminhtml\\Catalog\\Product\\Edit\\Tab\\Attributes',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar' => 
    array (
      'Bundle' => 
      array (
        'sortOrder' => 200,
        'instance' => 'Magento\\Bundle\\Block\\Adminhtml\\Order\\Create\\Sidebar',
      ),
      'GroupedProduct' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\GroupedProduct\\Block\\Adminhtml\\Order\\Create\\Sidebar',
      ),
      'configurable' => 
      array (
        'sortOrder' => 200,
        'instance' => 'Magento\\ConfigurableProduct\\Block\\Adminhtml\\Order\\Create\\Sidebar',
      ),
    ),
    'Magento\\Bundle\\Model\\ResourceModel\\Selection\\Collection' => 
    array (
      'Bundle' => 
      array (
        'sortOrder' => 60,
        'instance' => 'Magento\\Bundle\\Model\\ResourceModel\\Selection\\Plugin\\Collection',
      ),
    ),
    'Magento\\Framework\\View\\TemplateEngineFactory' => 
    array (
      'debug_hints' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Developer\\Model\\TemplateEngine\\Plugin\\DebugHints',
      ),
    ),
    'Magento\\Catalog\\Block\\Adminhtml\\Product\\Attribute\\Edit\\Tab\\Front' => 
    array (
      'search_weigh' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Block\\Plugin\\FrontTabPlugin',
      ),
    ),
    'Magento\\Sales\\Model\\AdminOrder\\Product\\Quote\\Initializer' => 
    array (
      'sales_adminorder_quote_initializer_plugin' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\GroupedProduct\\Model\\Sales\\AdminOrder\\Product\\Quote\\Plugin\\Initializer',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Builder' => 
    array (
      'configurable' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Controller\\Adminhtml\\Product\\Builder\\Plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Validator' => 
    array (
      'configurable' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\Validator\\Plugin',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Invoice' => 
    array (
      'update_configurable_product_total_qty' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Model\\Order\\Invoice\\UpdateConfigurableProductTotalQty',
      ),
    ),
    'Magento\\Backend\\Block\\Widget\\Button\\ToolbarInterface' => 
    array (
      'login_as_customer_button_toolbar' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAdminUi\\Plugin\\Button\\ToolbarPlugin',
      ),
    ),
    'Magento\\Customer\\Model\\Customer\\DataProviderWithDefaultAddresses' => 
    array (
      'login_as_customer_customer_data_provider_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\DataProviderWithDefaultAddressesPlugin',
      ),
      'ShowVertexCustomerAttributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerDataProviderPlugin',
      ),
    ),
    'Magento\\Customer\\Model\\Metadata\\Form' => 
    array (
      'login_as_customer_customer_data_validate_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\CustomerDataValidatePlugin',
      ),
    ),
    'Magento\\LoginAsCustomerAdminUi\\Ui\\Customer\\Component\\Button\\DataProvider' => 
    array (
      'login_as_customer_button_data_provider_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\LoginAsCustomerButtonDataProviderPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\ImageUploader' => 
    array (
      'save_category_image' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryCatalogIntegration\\Plugin\\SaveBaseCategoryImageInformation',
      ),
    ),
    'Magento\\Ui\\Component\\Form\\Element\\DataType\\Media\\OpenDialogUrl' => 
    array (
      'new_media_gallery_open_dialog_url' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryIntegration\\Plugin\\NewMediaGalleryOpenDialogUrl',
      ),
    ),
    'Magento\\Framework\\File\\Uploader' => 
    array (
      'save_asset_image' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryIntegration\\Plugin\\SaveImageInformation',
      ),
    ),
    'Magento\\Cms\\Block\\Adminhtml\\Wysiwyg\\Images\\Content' => 
    array (
      'add_search_button' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdobeStockImageAdminUi\\Plugin\\AddSearchButton',
      ),
    ),
    'Magento\\MediaGalleryUi\\Model\\GetDetailsByAssetId' => 
    array (
      'add_adobe_stock_image_details_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdobeStockImageAdminUi\\Plugin\\AddAdobeStockImageDetailsPlugin',
      ),
    ),
    'Magento\\MediaGalleryUi\\Ui\\Component\\Listing\\Columns\\Source\\Options' => 
    array (
      'add_adobe_stock_source_option_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdobeStockImageAdminUi\\Plugin\\AddAdobeStockSourceOptionPlugin',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\Product\\ProductRuleIndexer' => 
    array (
      'productRuleReindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\CatalogRule\\Model\\Indexer\\ProductRuleReindex',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure' => 
    array (
      'paypal_system_configuration' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Model\\Config\\StructurePlugin',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Element\\Field' => 
    array (
      'paypal_system_configuration_field' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Model\\Config\\Structure\\Element\\FieldPlugin',
      ),
    ),
    'Magento\\Backend\\Block\\Store\\Switcher' => 
    array (
      'paypal_store_switcher' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Block\\Adminhtml\\Store\\SwitcherPlugin',
      ),
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed\\Index' => 
    array (
      'adminAuthentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Rss\\App\\Action\\Plugin\\BackendAuthentication',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute\\Save' => 
    array (
      'save_swatches_frontend_input' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Controller\\Adminhtml\\Product\\Attribute\\Plugin\\Save',
      ),
    ),
    'Magento\\AdminNotification\\Model\\ResourceModel\\System\\Message\\Collection\\Synchronized' => 
    array (
      'afterToArray' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AsynchronousOperations\\Model\\ResourceModel\\System\\Message\\Collection\\Synchronized\\Plugin',
      ),
    ),
    'Magento\\AdminNotification\\Ui\\Component\\DataProvider\\DataProvider' => 
    array (
      'afterGetMeta' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AsynchronousOperations\\Ui\\Component\\AdminNotification\\Plugin',
      ),
    ),
    'Magento\\Widget\\Model\\Widget' => 
    array (
      'change_widget_placeholder' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tinymce3\\Model\\Plugin\\Widget',
      ),
    ),
    'Magento\\Cms\\Model\\Page\\DataProvider' => 
    array (
      'google_optimizer_cms_page_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GoogleOptimizer\\Model\\Plugin\\Cms\\Page\\DataProvider',
      ),
      'mageworx_custom_canonical_cms_page_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoBase\\Plugin\\CustomCanonicalFormUpdate\\AddToCmsPageFormPlugin',
      ),
    ),
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Form\\NewCategoryDataProvider' => 
    array (
      'google_optimizer_product_new_category_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GoogleOptimizer\\Model\\Plugin\\Catalog\\Product\\Category\\DataProvider',
      ),
    ),
    'Magento\\Shipping\\Block\\Adminhtml\\Order\\Packaging' => 
    array (
      'usps' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Usps\\Block\\Adminhtml\\Order\\Packaging\\Plugin\\DisplayGirth',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Info' => 
    array (
      'klarnaCoreValidationInfo' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Klarna\\Core\\Plugin\\Sales\\Block\\Adminhtml\\Order\\View\\InfoPlugin',
      ),
      'mageworx_order_editor_add_device_info_to_customer_account_block' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrdersBase\\Plugin\\Block\\Sales\\Adminhtml\\Order\\View\\Info',
      ),
    ),
    'Magento\\InventoryConfigurationApi\\Model\\IsSourceItemManagementAllowedForProductTypeInterface' => 
    array (
      'mageworx_ordereditor_disable_msi' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableMSI',
      ),
    ),
    'Magento\\InventorySalesApi\\Api\\IsProductSalableInterface' => 
    array (
      'mageworx_ordereditor_disable_inventory_detection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableInventoryDetectionPlugin',
      ),
    ),
    'Magento\\InventorySales\\Plugin\\StockState\\CheckQuoteItemQtyPlugin' => 
    array (
      'mageworx_ordereditor_disable_qty_validation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableQtyValidationPlugin',
      ),
    ),
    'Magento\\CatalogInventory\\Observer\\QuantityValidatorObserver' => 
    array (
      'mageworx_ordereditor_disable_qty_validation_for_backorders' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableBackordersQtyValidationPlugin',
      ),
    ),
    'Magento\\GiftCardAccount\\Model\\Plugin\\TotalsCollector' => 
    array (
      'mageworx_order_editor_void_giftcard_totals' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\BeforeCollectTotalsPlugin',
      ),
    ),
    'Magento\\CustomerBalance\\Model\\Total\\Quote\\Customerbalance' => 
    array (
      'mageworx_order_editor_disable_storecredit_totals_collect' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\CollectCustomerBalancePlugin',
      ),
    ),
    'Magento\\Payment\\Model\\Method\\Adapter' => 
    array (
      'mageworx_ordereditor_authorizenet_capture_actual_amount_correct_amount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\AuthorizeNet\\SetActualAmountBeforeCapturePlugin',
      ),
    ),
    'Magento\\AuthorizenetAcceptjs\\Gateway\\Request\\CaptureDataBuilder' => 
    array (
      'mageworx_ordereditor_authorizenet_capture_actual_amount_add_amount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\AuthorizeNet\\CaptureActualAmountPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order' => 
    array (
      'synchronizeOrderGrid' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\SynchronizeOrderGrid',
      ),
    ),
    'MageWorx\\SeoReports\\Model\\Config\\Product' => 
    array (
      'addSeoNameToProductReportConfig' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoXTemplates\\Plugin\\AddSeoNameToProductReportAfterPlugin',
      ),
    ),
    'MageWorx\\SeoReports\\Model\\Config\\Category' => 
    array (
      'addSeoNameToCategoryReportConfig' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoXTemplates\\Plugin\\AddSeoNameToCategoryReportAfterPlugin',
      ),
    ),
    'Magento\\Backend\\Model\\View\\Result\\Page' => 
    array (
      'magedelight_base_modify_setactivemenu' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Base\\Plugin\\Magento\\Backend\\Model\\View\\Result\\Page',
      ),
    ),
    'Magento\\Backend\\Model\\Menu\\Item' => 
    array (
      'md_common_menu_item_newtab' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Base\\Plugin\\Magento\\Backend\\Model\\Menu\\Item',
      ),
      'md_monerisca_menu_item_newtab' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Monerisca\\Plugin\\Magento\\Backend\\Model\\Menu\\Item',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Data' => 
    array (
      'mageplaza_module_activate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Core\\Model\\Config\\Structure\\Data',
      ),
    ),
    'Magento\\Backend\\Model\\Menu\\Builder\\AbstractCommand' => 
    array (
      'mageplaza_move_menu' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Core\\Plugin\\MoveMenu',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Tab\\Info' => 
    array (
      'mp_delivery_information' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\DeliveryTime\\Block\\Adminhtml\\Plugin\\OrderViewTabInfo',
      ),
      'osc_additional_content' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Block\\Adminhtml\\Plugin\\OrderViewTabInfo',
      ),
    ),
    'Magento\\Ui\\Component\\Listing\\Columns\\Column' => 
    array (
      'osc_customer_grid' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Ui\\Component\\Listing\\Column',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Grid\\Collection' => 
    array (
      'braintreeSalesOrderGrid' => 
      array (
        'sortOrder' => 0,
        'instance' => '\\PayPal\\Braintree\\Plugin\\SalesOrderGridPlugin',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Element\\Group' => 
    array (
      'ConfigGroupPlugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\GroupPlugin',
      ),
    ),
    'Magento\\Customer\\Model\\Customer\\DataProvider' => 
    array (
      'ShowVertexCustomerAttributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerDataProviderPlugin',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Form\\Address' => 
    array (
      'vertex_addressvalidation_admin_order_form' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Vertex\\AddressValidation\\Plugin\\Adminhtml\\AddBlockToOrderCreateForm',
      ),
    ),
    'Magento\\Backend\\Block\\Dashboard\\Grids' => 
    array (
      'yotpo_yotpo_backend_block_dashboard_grids_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Backend\\Block\\Dashboard\\Grids',
      ),
    ),
  ),
  1 => 
  array (
    'CustomerGirdFilterPool' => NULL,
    'CustomerGridCollectionReporting' => NULL,
    'Magento\\Cms\\Ui\\Component\\Form\\Field\\PageLayout' => NULL,
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\ProductCollectionFactory' => NULL,
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Form\\Modifier\\Pool' => NULL,
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Listing\\Modifier\\Pool' => NULL,
    'Magento\\Catalog\\Ui\\Component\\Form\\Field\\Category\\PageLayout' => NULL,
    'Magento\\MediaGalleryUi\\Model\\Api\\SearchCriteria\\CollectionProcessor\\FilterProcessor' => NULL,
    'Magento\\MediaGalleryUi\\Model\\Api\\SearchCriteria\\CollectionProcessor\\SortingProcessor' => NULL,
    'Magento\\MediaGalleryUi\\Model\\Api\\SearchCriteria\\CollectionProcessor\\PaginationProcessor' => NULL,
    'Magento\\MediaGalleryUi\\Model\\Api\\SearchCriteria\\CollectionProcessor\\JoinProcessor' => NULL,
    'Magento\\MediaGalleryUi\\Model\\Api\\SearchCriteria\\CollectionProcessor' => NULL,
    'Magento\\Catalog\\Ui\\BaseAllowedProductTypes' => NULL,
    'Magento\\CatalogSearch\\Model\\Session\\Storage' => NULL,
    'Magento\\CatalogSearch\\Model\\Session' => NULL,
    'Magento\\Config\\Model\\Config\\Source\\Email\\Template\\Header' => NULL,
    'Magento\\Config\\Model\\Config\\Source\\Email\\Template\\Footer' => NULL,
    'Magento\\MediaGalleryCatalogUi\\Model\\SearchCriteria\\CollectionProcessor\\FilterProcessor\\Product' => NULL,
    'Magento\\MediaGalleryCatalogUi\\Model\\SearchCriteria\\CollectionProcessor\\FilterProcessor\\Category' => NULL,
    'Magento\\MediaGalleryCmsUi\\Model\\SearchCriteria\\CollectionProcessor\\FilterProcessor\\Page' => NULL,
    'Magento\\MediaGalleryCmsUi\\Model\\SearchCriteria\\CollectionProcessor\\FilterProcessor\\Block' => NULL,
    'Magento\\Paypal\\Model\\Session\\Storage' => NULL,
    'Magento\\Paypal\\Model\\Session' => NULL,
    'Magento\\Paypal\\Model\\PayflowSession\\Storage' => NULL,
    'Magento\\Paypal\\Model\\PayflowSession' => NULL,
    'Magento\\Swatches\\Block\\Adminhtml\\Product\\Attribute\\Edit\\FormFactory' => NULL,
    'Magento\\GoogleOptimizer\\Block\\Adminhtml\\Form\\CmsPage' => NULL,
    'Magento\\Wishlist\\Model\\Session\\Storage' => NULL,
    'Magento\\Wishlist\\Model\\Session' => NULL,
    'Magento\\Cron\\Ui\\Model\\ResourceModel\\Schedule\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Importer\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Rules\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Automation\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Campaign\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Contact\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Catalog\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Order\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Review\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Wishlist\\Collection' => NULL,
    'Dotdigitalgroup\\Email\\Ui\\Model\\ResourceModel\\Abandoned\\Collection' => NULL,
    'Dotdigitalgroup\\Sms\\Ui\\Model\\ResourceModel\\SmsOrder\\Collection' => NULL,
    'Magento\\Payment\\Gateway\\Request\\BuilderInterface' => NULL,
    'Magento\\Payment\\Gateway\\Request\\BuilderComposite' => NULL,
    'BraintreeAuthorizeRequest' => NULL,
    'BraintreeVaultAuthorizeRequest' => NULL,
    'Magento\\Framework\\DB\\Adapter\\AdapterInterface' => 
    array (
      'execute_commit_callbacks' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\Model\\ExecuteCommitCallbacks',
      ),
    ),
    'Laminas\\Stdlib\\MessageInterface' => NULL,
    'Laminas\\Stdlib\\Message' => NULL,
    'Laminas\\Http\\AbstractMessage' => NULL,
    'Laminas\\Stdlib\\ResponseInterface' => NULL,
    'Laminas\\Http\\Response' => NULL,
    'Laminas\\Http\\PhpEnvironment\\Response' => NULL,
    'Magento\\Framework\\App\\Response\\HttpInterface' => NULL,
    'Magento\\Framework\\App\\ResponseInterface' => NULL,
    'Magento\\Framework\\HTTP\\PhpEnvironment\\Response' => NULL,
    'Magento\\Framework\\App\\Response\\Http' => 
    array (
      'genericHeaderPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Response\\HeaderManager',
      ),
      'magetrend-network-error-fix' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\App\\Response\\Http',
      ),
    ),
    'Magento\\Framework\\App\\ActionInterface' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Framework\\Url\\SecurityInfoInterface' => NULL,
    'Magento\\Framework\\Url\\SecurityInfo' => 
    array (
      'storeUrlSecurityInfo' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\Url\\Plugin\\SecurityInfo',
      ),
    ),
    'ArrayAccess' => NULL,
    'Magento\\Framework\\DataObject' => NULL,
    'Magento\\Framework\\Url\\RouteParamsResolverInterface' => NULL,
    'Magento\\Framework\\Url\\RouteParamsResolver' => 
    array (
      'storeUrlRouteParamsResolver' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\Url\\Plugin\\RouteParamsResolver',
      ),
    ),
    'Magento\\Framework\\Model\\AbstractModel' => NULL,
    'Magento\\Framework\\Api\\CustomAttributesDataInterface' => NULL,
    'Magento\\Framework\\Api\\ExtensibleDataInterface' => NULL,
    'Magento\\Framework\\Model\\AbstractExtensibleModel' => NULL,
    'Magento\\Framework\\App\\ScopeInterface' => NULL,
    'Magento\\Framework\\Url\\ScopeInterface' => 
    array (
      'urlSignature' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Url\\Plugin\\Signature',
      ),
    ),
    'Magento\\Framework\\DataObject\\IdentityInterface' => NULL,
    'Magento\\Store\\Api\\Data\\StoreInterface' => NULL,
    'Magento\\Store\\Model\\Store' => 
    array (
      'urlSignature' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Url\\Plugin\\Signature',
      ),
      'themeDesignConfigGridIndexerStore' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Indexer\\Design\\Config\\Plugin\\Store',
      ),
    ),
    'Magento\\Framework\\Config\\ConverterInterface' => NULL,
    'Magento\\Framework\\App\\Config\\Initial\\Converter' => 
    array (
      'cron_system_config_initial_converter_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Cron\\Model\\System\\Config\\Initial\\Converter',
      ),
    ),
    'Magento\\Framework\\App\\FrontControllerInterface' => 
    array (
      'default_store_setter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\FrontController\\Plugin\\DefaultStore',
      ),
      'configHash' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Deploy\\Model\\Plugin\\ConfigChangeDetector',
      ),
    ),
    'Magento\\Framework\\App\\FrontController' => 
    array (
      'default_store_setter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\FrontController\\Plugin\\DefaultStore',
      ),
      'storeCookieValidate' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Store\\Model\\Plugin\\StoreCookie',
      ),
      'install' => 
      array (
        'sortOrder' => 40,
        'instance' => 'Magento\\Framework\\Module\\Plugin\\DbStatusValidator',
      ),
      'configHash' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Deploy\\Model\\Plugin\\ConfigChangeDetector',
      ),
    ),
    'Magento\\Cms\\Model\\Wysiwyg\\Images\\Storage' => 
    array (
      'media_gallery_image_remove_metadata_after_wysiwyg' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'Magento\\MediaGallery\\Plugin\\Wysiwyg\\Images\\Storage',
      ),
    ),
    'Magento\\ImportExport\\Model\\Import\\Entity\\AbstractEntity' => NULL,
    'Magento\\AdvancedPricingImportExport\\Model\\Import\\AdvancedPricing' => 
    array (
      'invalidateAdvancedPriceIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdvancedPricingImportExport\\Model\\Indexer\\Product\\Price\\Plugin\\Import',
      ),
    ),
    'Magento\\Theme\\Api\\DesignConfigRepositoryInterface' => NULL,
    'Magento\\Theme\\Model\\DesignConfigRepository' => 
    array (
      'save_design_settings_event_dispatching' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Design\\Config\\Plugin',
      ),
    ),
    'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\CollectionFactory' => 
    array (
      'mageworx_ordersgrid_change_grid_collection' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\ChangeGridCollection',
      ),
    ),
    'Magento\\Store\\Api\\Data\\WebsiteInterface' => NULL,
    'Magento\\Store\\Model\\Website' => 
    array (
      'themeDesignConfigGridIndexerWebsite' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Indexer\\Design\\Config\\Plugin\\Website',
      ),
      'reindex_customer_grid_after_website_remove' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerGridIndexAfterWebsiteDelete',
      ),
      'reindex_after_delete_website' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Website',
      ),
    ),
    'Magento\\Store\\Api\\Data\\GroupInterface' => NULL,
    'Magento\\Store\\Model\\Group' => 
    array (
      'themeDesignConfigGridIndexerStoreGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Indexer\\Design\\Config\\Plugin\\StoreGroup',
      ),
    ),
    'Magento\\Config\\App\\Config\\Source\\DumpConfigSourceInterface' => NULL,
    'Magento\\Framework\\App\\Config\\ConfigSourceInterface' => NULL,
    'Magento\\Config\\App\\Config\\Source\\DumpConfigSourceAggregated' => 
    array (
      'designConfigTheme' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Theme\\Model\\Design\\Config\\Plugin\\Dump',
      ),
    ),
    'IteratorAggregate' => NULL,
    'Countable' => NULL,
    'Magento\\Framework\\Option\\ArrayInterface' => NULL,
    'Magento\\Framework\\Data\\CollectionDataSourceInterface' => NULL,
    'Traversable' => NULL,
    'Magento\\Framework\\Data\\OptionSourceInterface' => NULL,
    'Magento\\Framework\\View\\Element\\Block\\ArgumentInterface' => NULL,
    'Magento\\Framework\\Data\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Consumer\\Config\\ReaderInterface' => NULL,
    'Magento\\Framework\\Config\\ReaderInterface' => NULL,
    'Magento\\Framework\\MessageQueue\\Consumer\\Config\\CompositeReader' => 
    array (
      'queueConfigPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\MessageQueue\\Config\\Consumer\\ConfigReaderPlugin',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Publisher\\Config\\ReaderInterface' => NULL,
    'Magento\\Framework\\MessageQueue\\Publisher\\Config\\CompositeReader' => 
    array (
      'queueConfigPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\MessageQueue\\Config\\Publisher\\ConfigReaderPlugin',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Topology\\Config\\ReaderInterface' => NULL,
    'Magento\\Framework\\MessageQueue\\Topology\\Config\\CompositeReader' => 
    array (
      'queueConfigPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\MessageQueue\\Config\\Topology\\ConfigReaderPlugin',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Bulk\\ExchangeInterface' => NULL,
    'Magento\\Framework\\Amqp\\Bulk\\Exchange' => 
    array (
      'amqpStoreIdFieldForAmqpBulkExchange' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AmqpStore\\Plugin\\Framework\\Amqp\\Bulk\\Exchange',
      ),
    ),
    'Magento\\AsynchronousOperations\\Model\\MassConsumerEnvelopeCallback' => 
    array (
      'amqpStoreIdFieldForAsynchronousOperationsMassConsumerEnvelopeCallback' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AmqpStore\\Plugin\\AsynchronousOperations\\MassConsumerEnvelopeCallback',
      ),
    ),
    'Magento\\Framework\\App\\Config\\ValueInterface' => NULL,
    'Magento\\Framework\\App\\Config\\Value' => 
    array (
      'admin_system_config_media_gallery_renditions' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\UpdateRenditionsOnConfigChange',
      ),
      'admin_system_config_adobe_stock_save_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGallerySynchronization\\Plugin\\MediaGallerySyncTrigger',
      ),
      'webapiResourceSecurityCacheInvalidate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiSecurity\\Model\\Plugin\\CacheInvalidator',
      ),
    ),
    'Magento\\Authorization\\Model\\Role' => 
    array (
      'updateRoleUsersAcl' => 
      array (
        'sortOrder' => 20,
        'instance' => 'Magento\\User\\Model\\Plugin\\AuthorizationRole',
      ),
    ),
    'Magento\\Framework\\Model\\ResourceModel\\AbstractResource' => NULL,
    'Magento\\Framework\\Model\\ResourceModel\\Db\\AbstractDb' => NULL,
    'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute' => 
    array (
      'storeLabelCaching' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Eav\\Plugin\\Model\\ResourceModel\\Entity\\Attribute',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\EntityInterface' => NULL,
    'Magento\\Eav\\Model\\ResourceModel\\Attribute\\DefaultEntityAttributes\\ProviderInterface' => NULL,
    'Magento\\Eav\\Model\\Entity\\AbstractEntity' => 
    array (
      'clean_cache' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Cache\\FlushCacheByTags',
      ),
    ),
    'Magento\\Framework\\Data\\Collection\\AbstractDb' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\Framework\\App\\ResourceConnection\\SourceProviderInterface' => NULL,
    'Magento\\Eav\\Model\\Entity\\Collection\\AbstractCollection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Collection\\VersionControl\\AbstractCollection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\Customer\\Model\\ResourceModel\\Customer\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
      'amazon_login_customer_collection' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CustomerCollection',
      ),
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface' => 
    array (
      'transactionWrapper' => 
      array (
        'sortOrder' => -1,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerRepository\\TransactionWrapper',
      ),
      'login_as_customer_customer_repository_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\CustomerPlugin',
      ),
      'update_newsletter_subscription_on_customer_update' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Newsletter\\Model\\Plugin\\CustomerPlugin',
      ),
      'extensionAttributeVertexCustomerCode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerRepositoryPlugin',
      ),
      'extensionAttributeVertexCustomerCountry' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerCountryAttributePlugin',
      ),
      'amazon_login_customer_repository' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CustomerRepository',
      ),
    ),
    'Magento\\Directory\\Model\\AllowedCountries' => 
    array (
      'customerAllowedCountries' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\AllowedCountries',
      ),
    ),
    'Magento\\Framework\\Event\\ObserverInterface' => NULL,
    'Magento\\PageCache\\Observer\\FlushFormKey' => 
    array (
      'customerFlushFormKey' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerFlushFormKey',
      ),
    ),
    'Magento\\Customer\\Api\\AccountManagementInterface' => NULL,
    'Magento\\Customer\\Model\\AccountManagement' => 
    array (
      'security_check_customer_password_reset_attempt' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\AccountManagement',
      ),
      'mz_osc_newaccount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\AccountManagement',
      ),
      'mpsmtp_account_management' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Smtp\\Plugin\\AccountManagement',
      ),
      'AccountManagementPlugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Cart2Cart\\Login\\Plugin\\AccountManagement',
      ),
    ),
    'Magento\\Framework\\Config\\DataInterface' => NULL,
    'Magento\\Framework\\Config\\Data' => NULL,
    'Magento\\Indexer\\Model\\Config\\Data' => 
    array (
      'indexerCategoryFlatConfigGet' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Flat\\Plugin\\IndexerConfigData',
      ),
      'indexerProductFlatConfigGet' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Flat\\Plugin\\IndexerConfigData',
      ),
    ),
    'Magento\\Indexer\\Model\\Processor' => 
    array (
      'page-cache-indexer-reindex-clean-cache' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Indexer\\Model\\Processor\\CleanCache',
      ),
    ),
    'Magento\\Framework\\Indexer\\ActionInterface' => 
    array (
      'cache_cleaner_after_reindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Indexer\\Model\\Indexer\\CacheCleaner',
      ),
    ),
    'Magento\\Catalog\\Model\\AbstractModel' => NULL,
    'Magento\\Framework\\Pricing\\SaleableInterface' => NULL,
    'Magento\\Catalog\\Api\\Data\\ProductInterface' => NULL,
    'Magento\\Catalog\\Model\\Product' => 
    array (
      'catalogInventoryAfterLoad' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\AfterProductLoad',
      ),
      'product_identities_extender' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Plugin\\ProductIdentitiesExtender',
      ),
      'exclude_swatch_attribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\Product',
      ),
      'cms' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Cms\\Model\\Plugin\\Product',
      ),
      'add_bundle_parent_identities' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Bundle\\Model\\Plugin\\ProductIdentitiesExtender',
      ),
    ),
    'Magento\\ImportExport\\Model\\AbstractModel' => NULL,
    'Magento\\ImportExport\\Model\\Import' => 
    array (
      'catalogProductFlatIndexerImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Flat\\Plugin\\Import',
      ),
      'invalidatePriceIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Price\\Plugin\\Import',
      ),
      'invalidateStockIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Stock\\Plugin\\Import',
      ),
      'invalidateEavIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Eav\\Plugin\\Import',
      ),
      'invalidateProductCategoryIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Product\\Category\\Plugin\\Import',
      ),
      'invalidateCategoryProductIndexerOnImport' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogImportExport\\Model\\Indexer\\Category\\Product\\Plugin\\Import',
      ),
      'reindex_after_import' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\ImportExport',
      ),
    ),
    'Magento\\Customer\\Model\\ResourceModel\\Visitor' => 
    array (
      'catalogLog' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\Log',
      ),
      'reportLog' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Reports\\Model\\Plugin\\Log',
      ),
    ),
    'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\DataProviderInterface' => NULL,
    'Magento\\Ui\\DataProvider\\AbstractDataProvider' => NULL,
    'Magento\\Ui\\DataProvider\\ModifierPoolDataProvider' => NULL,
    'Magento\\Catalog\\Model\\Category\\DataProvider' => 
    array (
      'set_page_layout_default_value' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\SetPageLayoutDefaultValue',
      ),
      'category_ui_form_url_key_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\Catalog\\Block\\Adminhtml\\Category\\Tab\\Attributes',
      ),
      'google_optimizer_category_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GoogleOptimizer\\Model\\Plugin\\Catalog\\Category\\DataProvider',
      ),
      'mageworx_custom_canonical_category_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoBase\\Plugin\\CustomCanonicalFormUpdate\\AddToCategoryFormPlugin',
      ),
      'mageworxAddCategoryCustomAttributes' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'MageWorx\\SeoAll\\Plugin\\AddCategoryCustomAttributesPlugin',
      ),
    ),
    'Magento\\Framework\\View\\Element\\BlockInterface' => NULL,
    'Magento\\Framework\\View\\Element\\AbstractBlock' => NULL,
    'Magento\\Framework\\View\\Element\\Template' => NULL,
    'Magento\\Theme\\Block\\Html\\Topmenu' => 
    array (
      'catalogTopmenu' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Block\\Topmenu',
      ),
    ),
    'Magento\\Framework\\Mview\\View\\StateInterface' => 
    array (
      'setStatusForMview' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\MviewState',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Website' => 
    array (
      'invalidatePriceIndexerOnWebsite' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Price\\Plugin\\Website',
      ),
      'categoryProductWebsiteAfterDelete' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\Website',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Store' => 
    array (
      'storeViewResourceAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Flat\\Plugin\\StoreView',
      ),
      'catalogProductFlatIndexerStore' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Flat\\Plugin\\Store',
      ),
      'categoryStoreAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\StoreView',
      ),
      'productAttributesStoreViewSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Eav\\Plugin\\StoreView',
      ),
      'catalogsearchFulltextIndexerStoreView' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Store\\View',
      ),
      'store_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Store\\View',
      ),
      'update_cms_url_rewrites_after_store_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CmsUrlRewrite\\Plugin\\Cms\\Model\\Store\\View',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Group' => 
    array (
      'storeGroupResourceAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Flat\\Plugin\\StoreGroup',
      ),
      'catalogProductFlatIndexerStoreGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Flat\\Plugin\\StoreGroup',
      ),
      'categoryStoreGroupAroundSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Plugin\\StoreGroup',
      ),
      'storeGroupResourceAroundBeforeSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Indexer\\Stock\\Plugin\\StoreGroup',
      ),
      'catalogsearchFulltextIndexerStoreGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Store\\Group',
      ),
      'group_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Store\\Group',
      ),
    ),
    'Magento\\Customer\\Api\\GroupRepositoryInterface' => 
    array (
      'invalidatePriceIndexerOnCustomerGroup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Price\\Plugin\\CustomerGroup',
      ),
    ),
    'Magento\\Eav\\Api\\Data\\AttributeSetInterface' => NULL,
    'Magento\\Eav\\Model\\Entity\\Attribute\\Set' => 
    array (
      'invalidateEavIndexerOnAttributeSetSave' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Indexer\\Product\\Eav\\Plugin\\AttributeSet',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\TypeTransitionManager' => 
    array (
      'downloadable_product_transition' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Downloadable\\Model\\Product\\TypeTransitionManager\\Plugin\\Downloadable',
      ),
      'configurable_product_transition' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\TypeTransitionManager\\Plugin\\Configurable',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Config\\Backend\\AbstractValue' => 
    array (
      'admin_system_config_media_gallery_renditions' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\UpdateRenditionsOnConfigChange',
      ),
      'admin_system_config_adobe_stock_save_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGallerySynchronization\\Plugin\\MediaGallerySyncTrigger',
      ),
      'webapiResourceSecurityCacheInvalidate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiSecurity\\Model\\Plugin\\CacheInvalidator',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Config\\Backend\\ShowOutOfStock' => 
    array (
      'admin_system_config_media_gallery_renditions' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\UpdateRenditionsOnConfigChange',
      ),
      'admin_system_config_adobe_stock_save_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGallerySynchronization\\Plugin\\MediaGallerySyncTrigger',
      ),
      'webapiResourceSecurityCacheInvalidate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiSecurity\\Model\\Plugin\\CacheInvalidator',
      ),
      'showOutOfStockValueChanged' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\ShowOutOfStockConfig',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Config' => 
    array (
      'productListingAttributesCaching' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\ResourceModel\\Config',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Attribute\\Backend\\BackendInterface' => NULL,
    'Magento\\Eav\\Model\\Entity\\Attribute\\Backend\\AbstractBackend' => 
    array (
      'attributeValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\Attribute\\Backend\\AttributeValidation',
      ),
      'ConfigurableProduct::skipValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Model\\Attribute\\Backend\\AttributeValidation',
      ),
    ),
    'Magento\\Sales\\Api\\OrderItemRepositoryInterface' => 
    array (
      'get_gift_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\OrderItemGet',
      ),
      'vertex_commodity_code_order_item_repository' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommodityCodeExtensionAttributeOrderItemRepository',
      ),
    ),
    'Magento\\Framework\\EntityManager\\Operation\\AttributeInterface' => NULL,
    'Magento\\Eav\\Model\\ResourceModel\\ReadHandler' => NULL,
    'Magento\\Eav\\Model\\ResourceModel\\ReadSnapshot' => 
    array (
      'catalogReadSnapshot' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\ResourceModel\\ReadSnapshotPlugin',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Item\\ToOrderItem' => 
    array (
      'copy_quote_files_to_order' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Model\\Plugin\\QuoteItemProductOption',
      ),
      'append_bundle_data_to_order' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Bundle\\Model\\Plugin\\QuoteItem',
      ),
      'gift_message_quote_item_conversion' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\QuoteItem',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper' => 
    array (
      'weeeAttributeOptionsProcess' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Weee\\Plugin\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\ProcessTaxAttribute',
      ),
      'vertex_custom_option_flex_field_after_save_initialization' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomOptionFlexFieldExtensionAttributeInitializer',
      ),
      'product_save_rewrites_history_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper',
      ),
      'configurable' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\Configurable',
      ),
      'Bundle' => 
      array (
        'sortOrder' => 60,
        'instance' => 'Magento\\Bundle\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\Bundle',
      ),
      'updateConfigurations' => 
      array (
        'sortOrder' => 60,
        'instance' => 'Magento\\ConfigurableProduct\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\UpdateConfigurations',
      ),
      'Downloadable' => 
      array (
        'sortOrder' => 70,
        'instance' => 'Magento\\Downloadable\\Controller\\Adminhtml\\Product\\Initialization\\Helper\\Plugin\\Downloadable',
      ),
      'cleanConfigurationTmpImages' => 
      array (
        'sortOrder' => 999,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Product\\Initialization\\CleanConfigurationTmpImages',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductAttributeRepositoryInterface' => NULL,
    'Magento\\Framework\\Api\\MetadataServiceInterface' => NULL,
    'Magento\\Catalog\\Model\\Product\\Attribute\\Repository' => 
    array (
      'filterCustomAttribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\FilterCustomAttribute',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\AbstractProduct' => 
    array (
      'add_product_object_to_image_data_array' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\ProductImage',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View' => 
    array (
      'add_product_object_to_image_data_array' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\ProductImage',
      ),
      'quantityValidators' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Block\\Plugin\\ProductView',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Action' => 
    array (
      'ReindexUpdatedProducts' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\ReindexUpdatedProducts',
      ),
      'quoteProductMassChange' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Quote\\Model\\Product\\Plugin\\MarkQuotesRecollectMassDisabled',
      ),
      'catalogsearchFulltextMassAction' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Product\\Action',
      ),
      'invalidate_pagecache_after_update_product_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\Product\\Action\\UpdateAttributesFlushCache',
      ),
      'price_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Model\\Product\\Action',
      ),
    ),
    'Magento\\Framework\\App\\Action\\AbstractAction' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Framework\\App\\Action\\Action' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Backend\\App\\AbstractAction' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Backend\\App\\Action' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Framework\\App\\Action\\HttpPostActionInterface' => NULL,
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute\\Save' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'massAction' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Plugin\\MassUpdateProductAttribute',
      ),
      'Ddg_UpdateProductAttribute_MassActionPlugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CatalogProductAttributeSavePlugin',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\AbstractResource' => 
    array (
      'clean_cache' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Cache\\FlushCacheByTags',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Category' => 
    array (
      'clean_cache' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Cache\\FlushCacheByTags',
      ),
      'category_move_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Category\\Move',
      ),
      'category_delete_plugin' => 
      array (
        'sortOrder' => 0,
        'disabled' => true,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Category\\Remove',
      ),
      'update_url_path_for_different_stores' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Category\\UpdateUrlPath',
      ),
      'catalogsearchFulltextCategory' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Category',
      ),
      'fulltext_search_indexer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Model\\Plugin\\Category',
      ),
      'mw_category_delete_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'MageWorx\\SeoRedirects\\Plugin\\CategoryPlugin',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\StorageInterface' => 
    array (
      'storage_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Storage',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\UrlPersistInterface' => NULL,
    'Magento\\UrlRewrite\\Model\\UrlFinderInterface' => NULL,
    'Magento\\UrlRewrite\\Model\\Storage\\AbstractStorage' => 
    array (
      'storage_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Storage',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\Storage\\DbStorage' => 
    array (
      'storage_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Storage',
      ),
    ),
    'Magento\\CatalogUrlRewrite\\Model\\Storage\\DbStorage' => 
    array (
      'storage_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Model\\Category\\Plugin\\Storage',
      ),
      'dynamic_storage_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\DynamicCategoryRewrites',
      ),
    ),
    'Magento\\Framework\\Config\\Reader\\Filesystem' => NULL,
    'Magento\\Framework\\Search\\Request\\Config\\FilesystemReader' => 
    array (
      'productAttributesDynamicFields' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogGraphQl\\Plugin\\Search\\Request\\ConfigReader',
      ),
      'catalogSearchDynamicFields' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Search\\ReaderPlugin',
      ),
    ),
    'Magento\\Framework\\View\\Layout\\ProcessorInterface' => NULL,
    'Magento\\Framework\\View\\Model\\Layout\\Merge' => 
    array (
      'widget-layout-update-plugin' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Widget\\Model\\ResourceModel\\Layout\\Plugin',
      ),
    ),
    'Magento\\Quote\\Api\\CartRepositoryInterface' => 
    array (
      'mageworx_order_editor_add_edit_in_progress_extension_attribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Quote\\AddEditInProgressExtensionAttributeToQuote',
      ),
      'amazon_payment_quote_repository' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\QuoteRepository',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository' => 
    array (
      'mageworx_order_editor_add_edit_in_progress_extension_attribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Quote\\AddEditInProgressExtensionAttributeToQuote',
      ),
      'multishipping_quote_repository' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Multishipping\\Plugin\\MultishippingQuoteRepository',
      ),
      'amazon_payment_quote_repository' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\QuoteRepository',
      ),
    ),
    'Magento\\Customer\\Model\\Address\\AddressModelInterface' => NULL,
    'Magento\\Customer\\Model\\Address\\AbstractAddress' => NULL,
    'Magento\\Quote\\Api\\Data\\AddressInterface' => NULL,
    'Magento\\Quote\\Model\\Quote\\Address' => 
    array (
      'mposc_convert_quote_address_to_customer_address' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address\\ConvertQuoteAddressToCustomerAddress',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product' => 
    array (
      'clean_cache' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Cache\\FlushCacheByTags',
      ),
      'clean_quote_items_after_product_delete' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Quote\\Model\\Product\\Plugin\\RemoveQuoteItems',
      ),
      'update_quote_items_after_product_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Quote\\Model\\Product\\Plugin\\UpdateQuoteItems',
      ),
      'catalogsearchFulltextProduct' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Product',
      ),
      'vertex_commodity_code_product_resource_model' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommodityCodeExtensionAttributeProductResourceModelPlugin',
      ),
      'apply_catalog_rules_after_product_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Product\\Save\\ApplyRules',
      ),
      'reload_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Model\\ResourceModel\\Product',
      ),
      'cleanups_wishlist_item_after_product_delete' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Wishlist\\Plugin\\Model\\ResourceModel\\Product',
      ),
    ),
    'Magento\\MediaGallerySynchronizationApi\\Model\\ImportFilesInterface' => NULL,
    'Magento\\MediaGallerySynchronizationApi\\Model\\ImportFilesComposite' => 
    array (
      'createMediaGalleryThumbnails' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryUi\\Plugin\\CreateThumbnails',
      ),
    ),
    'Magento\\Cms\\Model\\ResourceModel\\Page' => 
    array (
      'cms_url_rewrite_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CmsUrlRewrite\\Plugin\\Cms\\Model\\ResourceModel\\Page',
        'disabled' => true,
      ),
      'mw_cms_url_rewrite_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'MageWorx\\SeoRedirects\\Plugin\\CmsPagePlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\View' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Creditmemo' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\OrderInterface' => NULL,
    'Magento\\Framework\\App\\Action\\HttpGetActionInterface' => NULL,
    'Magento\\Framework\\App\\Action\\HttpHeadActionInterface' => NULL,
    'Magento\\Sales\\Controller\\Order\\Creditmemo' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\History' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Invoice' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Invoice' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintAction' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintAction' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-order-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintAction',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintCreditmemo' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintCreditmemo' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-creditmemo-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintCreditmemo',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintInvoice' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintInvoice' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-invoice-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintInvoice',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintShipment' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintShipment' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
      'magetrend-shipment-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Order\\PrintShipment',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Reorder' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Reorder' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Shipment' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Shipment' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\View' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Controller\\Order\\Plugin\\Authentication',
      ),
    ),
    'Magento\\Framework\\Model\\ResourceModel\\Db\\VersionControl\\AbstractDb' => NULL,
    'Magento\\Sales\\Model\\ResourceModel\\EntityAbstract' => NULL,
    'Magento\\Sales\\Model\\Spi\\OrderResourceInterface' => NULL,
    'Magento\\Sales\\Model\\ResourceModel\\Order' => 
    array (
      'mageworx_ordersgrid_sync_order' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\Spi\\InvoiceResourceInterface' => NULL,
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Invoice' => 
    array (
      'mageworx_ordersgrid_sync_order_invoice' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\Spi\\ShipmentResourceInterface' => NULL,
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Shipment' => 
    array (
      'mageworx_ordersgrid_sync_order_shipment' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Handler\\Address' => 
    array (
      'addressUpdate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Sales\\Model\\Order\\Invoice\\Plugin\\AddressUpdate',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Converter' => 
    array (
      'cron_backend_config_structure_converter_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Cron\\Model\\Backend\\Config\\Structure\\Converter',
      ),
    ),
    'Magento\\Framework\\App\\RouterInterface' => 
    array (
      'csp_aware_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Csp\\Plugin\\CspAwareControllerPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Backend\\Price' => 
    array (
      'attributeValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\Attribute\\Backend\\AttributeValidation',
      ),
      'ConfigurableProduct::skipValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Model\\Attribute\\Backend\\AttributeValidation',
      ),
      'bundle' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Bundle\\Model\\Plugin\\PriceBackend',
      ),
      'configurable' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Plugin\\PriceBackend',
      ),
    ),
    'Magento\\Sales\\Model\\AbstractModel' => NULL,
    'Magento\\Sales\\Api\\Data\\OrderItemInterface' => NULL,
    'Magento\\Sales\\Model\\Order\\Item' => 
    array (
      'bundle' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Bundle\\Model\\Sales\\Order\\Plugin\\Item',
      ),
    ),
    'Magento\\Integration\\Api\\IntegrationServiceInterface' => 
    array (
      'webapiIntegrationService' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Integration\\Model\\Plugin\\Integration',
      ),
    ),
    'Magento\\Backend\\Model\\Auth\\Credential\\StorageInterface' => NULL,
    'Magento\\User\\Api\\Data\\UserInterface' => NULL,
    'Magento\\User\\Model\\User' => 
    array (
      'revokeTokensFromInactiveAdmins' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Integration\\Plugin\\Model\\AdminUser',
      ),
    ),
    'Magento\\Customer\\Model\\Customer' => 
    array (
      'revokeTokensFromInactiveCustomers' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Integration\\Plugin\\Model\\CustomerUser',
      ),
      'ddg_customer_sendNewAccountEmail_disabler' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CustomerPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\CartConfiguration' => 
    array (
      'Downloadable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Downloadable\\Model\\Product\\CartConfiguration\\Plugin\\Downloadable',
      ),
      'isProductConfigured' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\Product\\Cart\\Configuration\\Plugin\\Grouped',
      ),
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\CartConfiguration\\Plugin\\Configurable',
      ),
    ),
    'Magento\\Framework\\Controller\\ResultInterface' => NULL,
    'Magento\\Framework\\Controller\\AbstractResult' => NULL,
    'Magento\\Framework\\View\\Result\\Layout' => NULL,
    'Magento\\Framework\\View\\Result\\Page' => 
    array (
      'updateBodyClass' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Smartwave\\Porto\\Plugin\\UpdateBodyClass',
      ),
    ),
    'Magento\\Checkout\\Block\\Checkout\\LayoutProcessorInterface' => NULL,
    'Magento\\Checkout\\Block\\Cart\\LayoutProcessor' => 
    array (
      'checkout_cart_shipping_dhl' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Dhl\\Model\\Plugin\\Checkout\\Block\\Cart\\Shipping',
      ),
      'checkout_cart_shipping_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\OfflineShipping\\Model\\Plugin\\Checkout\\Block\\Cart\\Shipping',
      ),
    ),
    'Magento\\Customer\\Controller\\Ajax\\Login' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'captcha_validation' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Captcha\\Model\\Customer\\Plugin\\AjaxLogin',
      ),
    ),
    'Magento\\Checkout\\Block\\Cart\\AbstractCart' => NULL,
    'Magento\\Checkout\\Block\\Cart\\Sidebar' => 
    array (
      'login_captcha' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Captcha\\Model\\Cart\\ConfigPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\AbstractAction' => NULL,
    'Magento\\Catalog\\Model\\Indexer\\Product\\Category\\Action\\Rows' => 
    array (
      'catalogsearchFulltextCategoryAssignment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Product\\Category\\Action\\Rows',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute' => 
    array (
      'storeLabelCaching' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Eav\\Plugin\\Model\\ResourceModel\\Entity\\Attribute',
      ),
      'catalogsearchFulltextIndexerAttribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Plugin\\Attribute',
      ),
      'catalogsearchAttributeSearchWeightCache' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Attribute\\SearchWeight',
      ),
      'updateElasticsearchIndexerMapping' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Elasticsearch\\Model\\Indexer\\Fulltext\\Plugin\\Category\\Product\\Attribute',
      ),
      'invalidate_pagecache_after_attribute_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\ResourceModel\\Attribute\\Save',
      ),
    ),
    'Magento\\Catalog\\Model\\Layer\\CollectionFilterInterface' => NULL,
    'Magento\\Catalog\\Model\\Layer\\Search\\CollectionFilter' => 
    array (
      'searchQuery' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Layer\\Search\\Plugin\\CollectionFilter',
      ),
    ),
    'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Action\\DataProvider' => 
    array (
      'stockedProductsFilterPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Model\\Indexer\\Plugin\\StockedProductsFilterPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Action\\Rows' => 
    array (
      'catalogsearchFulltextProductAssignment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Elasticsearch\\Model\\Indexer\\Fulltext\\Plugin\\Category\\Product\\Action\\Rows',
      ),
    ),
    'Magento\\Framework\\Indexer\\Config\\DependencyInfoProviderInterface' => NULL,
    'Magento\\Framework\\Indexer\\Config\\DependencyInfoProvider' => 
    array (
      'indexerDependencyUpdaterPlugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Elasticsearch\\Model\\Indexer\\Plugin\\DependencyUpdaterPlugin',
      ),
    ),
    'Magento\\Framework\\App\\TemplateTypesInterface' => NULL,
    'Magento\\Email\\Model\\AbstractTemplate' => NULL,
    'Magento\\Framework\\Mail\\TemplateInterface' => NULL,
    'Magento\\Email\\Model\\Template' => 
    array (
      'dotmailer_template_plugin' => 
      array (
        'sortOrder' => 100,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\TemplatePlugin',
      ),
    ),
    'Magento\\Framework\\Mail\\TransportInterface' => 
    array (
      'WindowsSmtpConfig' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Email\\Model\\Plugin\\WindowsSmtpConfig',
      ),
      'EmailDisable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Email\\Model\\Mail\\TransportInterfacePlugin',
      ),
      'ddg_mail_transport' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\TransportPlugin',
      ),
      'mageplaza_mail_transport' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Mageplaza\\Smtp\\Mail\\Transport',
      ),
    ),
    'Magento\\Shipping\\Block\\DataProviders\\Tracking\\DeliveryDateTitle' => 
    array (
      'update_delivery_date_title' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Fedex\\Plugin\\Block\\DataProviders\\Tracking\\ChangeTitle',
      ),
      'ups_update_delivery_date_title' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Ups\\Plugin\\Block\\DataProviders\\Tracking\\ChangeTitle',
      ),
    ),
    'Magento\\Shipping\\Block\\Tracking\\Popup' => 
    array (
      'update_delivery_date_value' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Fedex\\Plugin\\Block\\Tracking\\PopupDeliveryDate',
      ),
    ),
    'Magento\\Sales\\Api\\OrderRepositoryInterface' => 
    array (
      'save_gift_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\OrderSave',
      ),
      'get_gift_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GiftMessage\\Model\\Plugin\\OrderGet',
      ),
      'save_order_tax' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Model\\Plugin\\OrderSave',
      ),
      'mageworx_order_base_save_device_data' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrdersBase\\Plugin\\Order\\SaveAttributes',
      ),
      'mageworx_order_base_get_device_data' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrdersBase\\Plugin\\Order\\GetAttributes',
      ),
      'mposc_add_order_comment_to_order_api' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Api\\OrderComment',
      ),
      'get_vertex_order_item_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\OrderRepositoryPlugin',
      ),
      'vertex_commodity_code_order_item_order_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\AddCommodityCodeToOrderItemPlugin',
      ),
      'addVertexCustomerCountryToOrderAddress' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\AddCustomerCountryToOrderAddressPlugin',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Identifier' => 
    array (
      'mplayerPagecacheIdentifier' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\LayeredNavigation\\Plugin\\PageCache\\Identifier',
      ),
      'core-app-area-design-exception-plugin' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\PageCache\\Model\\App\\CacheIdentifierPlugin',
      ),
    ),
    'Magento\\Framework\\App\\CacheInterface' => NULL,
    'Magento\\Framework\\App\\Cache' => NULL,
    'Magento\\Framework\\App\\PageCache\\Cache' => 
    array (
      'fpc-type-plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\PageCache\\Model\\App\\PageCachePlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Type' => 
    array (
      'grouped_output' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\Product\\Type\\Plugin',
      ),
      'configurable_output' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\Type\\Plugin',
      ),
    ),
    'Magento\\Framework\\App\\Helper\\AbstractHelper' => NULL,
    'Magento\\Catalog\\Helper\\Product\\Configuration\\ConfigurationInterface' => NULL,
    'Magento\\Catalog\\Helper\\Product\\Configuration' => 
    array (
      'grouped_options' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Helper\\Product\\Configuration\\Plugin\\Grouped',
      ),
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Helper\\Product\\Configuration\\Plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Initialization\\Helper\\ProductLinks' => 
    array (
      'GroupedProduct' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\Product\\Initialization\\Helper\\ProductLinks\\Plugin\\Grouped',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Link' => 
    array (
      'groupedProductLinkProcessor' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedProduct\\Model\\ResourceModel\\Product\\Link\\RelationPersister',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Type\\AbstractType' => NULL,
    'Magento\\GroupedProduct\\Model\\Product\\Type\\Grouped' => 
    array (
      'outOfStockFilter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GroupedCatalogInventory\\Plugin\\OutOfStockFilter',
      ),
      'grouped_product_minimum_advertised_price' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MsrpGroupedProduct\\Plugin\\Model\\Product\\Type\\Grouped',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Quote\\Item\\QuantityValidator\\Initializer\\Option' => 
    array (
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Quote\\Item\\QuantityValidator\\Initializer\\Option\\Plugin\\ConfigurableProduct',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Admin\\Item' => 
    array (
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Order\\Admin\\Item\\Plugin\\Configurable',
      ),
    ),
    'Magento\\Catalog\\Model\\Entity\\Product\\Attribute\\Group\\AttributeMapperInterface' => 
    array (
      'configurable_product' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Entity\\Product\\Attribute\\Group\\AttributeMapper\\Plugin',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductRepositoryInterface' => 
    array (
      'vertex_commodity_code_product_repository' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommodityCodeExtensionAttributeProductRepositoryPlugin',
      ),
      'configurableProductSaveOptions' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Plugin\\ProductRepositorySave',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\AbstractView' => 
    array (
      'add_product_object_to_image_data_array' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\ProductImage',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Gallery' => 
    array (
      'add_product_object_to_image_data_array' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\ProductImage',
      ),
    ),
    'Magento\\ProductVideo\\Block\\Product\\View\\Gallery' => 
    array (
      'add_product_object_to_image_data_array' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\ProductImage',
      ),
      'product_video_gallery' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Block\\Plugin\\Product\\Media\\Gallery',
      ),
    ),
    'Magento\\ConfigurableProduct\\Model\\Product\\Type\\Configurable' => 
    array (
      'add_swatch_attributes_to_configurable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\Configurable',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Pricing\\Renderer\\SalableResolverInterface' => NULL,
    'Magento\\Catalog\\Model\\Product\\Pricing\\Renderer\\SalableResolver' => 
    array (
      'configurable' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Catalog\\Model\\Product\\Pricing\\Renderer\\SalableResolver',
      ),
    ),
    'Magento\\Rule\\Model\\Condition\\ConditionInterface' => NULL,
    'Magento\\Rule\\Model\\Condition\\AbstractCondition' => NULL,
    'Magento\\Rule\\Model\\Condition\\Product\\AbstractProduct' => NULL,
    'Magento\\SalesRule\\Model\\Rule\\Condition\\Product' => 
    array (
      'apply_rule_on_configurable_children' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\SalesRule\\Model\\Rule\\Condition\\Product',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\Total\\CollectorInterface' => NULL,
    'Magento\\Quote\\Model\\Quote\\Address\\Total\\ReaderInterface' => NULL,
    'Magento\\Quote\\Model\\Quote\\Address\\Total\\AbstractTotal' => NULL,
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector' => 
    array (
      'apply_tax_class_id' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector',
      ),
      'vertexItemLevelMap' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommonTaxCollectorPlugin',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Backend\\Baseurl' => 
    array (
      'admin_system_config_media_gallery_renditions' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\UpdateRenditionsOnConfigChange',
      ),
      'admin_system_config_adobe_stock_save_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGallerySynchronization\\Plugin\\MediaGallerySyncTrigger',
      ),
      'webapiResourceSecurityCacheInvalidate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiSecurity\\Model\\Plugin\\CacheInvalidator',
      ),
      'updateAnalyticsSubscription' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Analytics\\Model\\Plugin\\BaseUrlConfigPlugin',
      ),
    ),
    'Magento\\Quote\\Api\\CartTotalRepositoryInterface' => NULL,
    'Magento\\Quote\\Model\\Cart\\CartTotalRepository' => 
    array (
      'multishipping_shipping_addresses' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Multishipping\\Model\\Cart\\CartTotalRepositoryPlugin',
      ),
      'coupon_label_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesRule\\Plugin\\CartTotalRepository',
      ),
    ),
    'Magento\\Integration\\Model\\ConfigBasedIntegrationManager' => 
    array (
      'webapiSetup' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Webapi\\Model\\Plugin\\Manager',
      ),
    ),
    'Magento\\Backend\\Model\\Auth' => 
    array (
      'login_as_customer_admin_logout' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomer\\Plugin\\AdminLogoutPlugin',
      ),
      'security_admin_sessions_login' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\Auth',
      ),
    ),
    'Magento\\Framework\\Api\\DataObjectHelper' => 
    array (
      'add_allow_remote_shopping_assistance_to_customer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerGraphQl\\Plugin\\DataObjectHelperPlugin',
      ),
    ),
    'Magento\\LoginAsCustomerApi\\Api\\AuthenticateCustomerBySecretInterface' => 
    array (
      'process_shopping_cart' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerQuote\\Plugin\\LoginAsCustomerApi\\ProcessShoppingCartPlugin',
      ),
    ),
    'Magento\\MediaGalleryApi\\Api\\DeleteAssetsByPathsInterface' => 
    array (
      'remove_media_content_after_asset_is_removed_by_path' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaContent\\Plugin\\MediaGalleryAssetDeleteByPath',
      ),
      'delete_renditions_on_assets_delete' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\RemoveRenditions',
      ),
    ),
    'Magento\\MediaGalleryApi\\Api\\DeleteDirectoriesByPathsInterface' => 
    array (
      'remove_media_content_after_asset_is_removed_by_directory_path' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaContent\\Plugin\\MediaGalleryAssetDeleteByDirectoryPath',
      ),
    ),
    'Magento\\MediaGallerySynchronization\\Model\\Consume' => 
    array (
      'synchronize_media_content' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaContentSynchronization\\Plugin\\SynchronizeMediaContent',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\Processor' => 
    array (
      'media_gallery_image_remove_metadata' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryCatalog\\Plugin\\Product\\Gallery\\RemoveAssetAfterRemoveImage',
      ),
    ),
    'Magento\\Cms\\Model\\Wysiwyg\\Images\\GetInsertImageContent' => 
    array (
      'set_rendition_path' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryRenditions\\Plugin\\SetRenditionPath',
      ),
    ),
    'Magento\\MediaGallerySynchronizationApi\\Model\\CreateAssetFromFileInterface' => 
    array (
      'addMetadataToAssetCreatedFromFile' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGallerySynchronizationMetadata\\Plugin\\CreateAssetFromFileMetadata',
      ),
    ),
    'Magento\\Framework\\App\\MaintenanceMode' => 
    array (
      'amqp_maintenance_mode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MessageQueue\\Model\\Plugin\\ResourceModel\\Lock',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Collection\\AbstractCollection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\ConfigurableProduct\\Model\\ResourceModel\\Product\\Type\\Configurable\\Product\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
      'catalogRulePriceForConfigurableProduct' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\ConfigurableProduct\\Model\\ResourceModel\\AddCatalogRulePrice',
      ),
    ),
    'Magento\\Framework\\AppInterface' => NULL,
    'Magento\\Framework\\App\\Http' => 
    array (
      'framework-http-newrelic' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\HttpPlugin',
      ),
    ),
    'Magento\\Framework\\App\\State' => 
    array (
      'framework-state-newrelic' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\StatePlugin',
      ),
    ),
    'Symfony\\Component\\Console\\Command\\Command' => 
    array (
      'newrelic-describe-commands' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\CommandPlugin',
      ),
    ),
    'Magento\\Framework\\Profiler\\Driver\\Standard\\Stat' => 
    array (
      'newrelic-describe-cronjobs' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\NewRelicReporting\\Plugin\\StatPlugin',
      ),
    ),
    'Magento\\Newsletter\\Model\\Subscriber' => 
    array (
      'ddg_newsletter_disabler' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\SubscriberPlugin',
      ),
    ),
    'Magento\\Quote\\Api\\CartManagementInterface' => NULL,
    'Magento\\Quote\\Model\\QuoteManagement' => 
    array (
      'validate_purchase_order_number' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\OfflinePayments\\Plugin\\ValidatePurchaseOrderNumber',
      ),
      'coupon_uses_increment_plugin' => 
      array (
        'sortOrder' => 20,
        'instance' => 'Magento\\SalesRule\\Plugin\\CouponUsagesIncrement',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Config' => 
    array (
      'append_sales_rule_keys_to_quote' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesRule\\Model\\Plugin\\QuoteConfigProductAttributes',
      ),
    ),
    'Magento\\Sales\\Api\\OrderManagementInterface' => NULL,
    'Magento\\Sales\\Model\\Service\\OrderService' => 
    array (
      'coupon_uses_decrement_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesRule\\Plugin\\CouponUsagesDecrement',
      ),
    ),
    'Magento\\Sales\\Api\\Data\\OrderPaymentInterface' => 
    array (
      'PaymentVaultExtensionAttributeOperations' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Vault\\Plugin\\PaymentVaultAttributesLoad',
      ),
    ),
    'Magento\\Checkout\\Api\\PaymentInformationManagementInterface' => 
    array (
      'ProcessPaymentVaultInformationManagement' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Vault\\Plugin\\PaymentVaultInformationManagement',
      ),
      'validate-agreements' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CheckoutAgreements\\Model\\Checkout\\Plugin\\Validation',
      ),
    ),
    'Magento\\Payment\\Model\\Checks\\SpecificationInterface' => NULL,
    'Magento\\Payment\\Model\\Checks\\Composite' => 
    array (
      'paypal_specification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Model\\Method\\Checks\\SpecificationPlugin',
      ),
    ),
    'Magento\\Sales\\Model\\EntityInterface' => NULL,
    'Magento\\Sales\\Api\\Data\\OrderInterface' => NULL,
    'Magento\\Sales\\Model\\Order' => 
    array (
      'express_order_invoice' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\OrderCanInvoice',
      ),
      'admin-order-placement-comment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerSales\\Plugin\\AdminAddCommentOnOrderPlacementPlugin',
      ),
    ),
    'Magento\\Sales\\Model\\ValidatorInterface' => NULL,
    'Magento\\Sales\\Model\\Order\\Validation\\CanInvoice' => 
    array (
      'express_order_invoice' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\ValidatorCanInvoice',
      ),
    ),
    'Magento\\Framework\\Session\\SessionStartChecker' => 
    array (
      'transparent_session_checker' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\TransparentSessionChecker',
      ),
    ),
    'Magento\\Payment\\Model\\InfoInterface' => NULL,
    'Magento\\Sales\\Model\\Order\\Payment\\Info' => NULL,
    'Magento\\Sales\\Model\\Order\\Payment' => 
    array (
      'PaymentVaultExtensionAttributeOperations' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Vault\\Plugin\\PaymentVaultAttributesLoad',
      ),
      'paypal_transparent' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Plugin\\TransparentOrderPayment',
      ),
      'amazon_pay_order_payment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Amazon\\Payment\\Plugin\\OrderCurrencyComment',
      ),
    ),
    'Magento\\Quote\\Model\\AddressAdditionalDataProcessor' => 
    array (
      'persistent_remember_me_checkbox_processor' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Persistent\\Model\\Checkout\\AddressDataProcessorPlugin',
      ),
    ),
    'Magento\\Customer\\CustomerData\\SectionSourceInterface' => NULL,
    'Magento\\Customer\\CustomerData\\Customer' => 
    array (
      'section_data' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Persistent\\Model\\Plugin\\CustomerData',
      ),
    ),
    'Magento\\Framework\\EntityManager\\Operation\\ExtensionInterface' => NULL,
    'Magento\\Catalog\\Model\\Product\\Gallery\\CreateHandler' => 
    array (
      'external_video_media_entry_saver' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ProductVideo\\Model\\Plugin\\Catalog\\Product\\Gallery\\CreateHandler',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\ReadHandler' => 
    array (
      'external_video_media_entry_reader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ProductVideo\\Model\\Plugin\\Catalog\\Product\\Gallery\\ReadHandler',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Gallery' => 
    array (
      'external_video_media_resource_backend' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ProductVideo\\Model\\Plugin\\ExternalVideoResourceBackend',
      ),
    ),
    'Magento\\Checkout\\Api\\GuestPaymentInformationManagementInterface' => 
    array (
      'validate-guest-agreements' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CheckoutAgreements\\Model\\Checkout\\Plugin\\GuestValidation',
      ),
      'guest_payment_no_commit_after_event_workaround' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\GuestPaymentInformationManagementPlugin',
      ),
    ),
    'Magento\\Framework\\View\\Asset\\MergeService' => 
    array (
      'cleanMergedJsCss' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaStorage\\Model\\Asset\\Plugin\\CleanMergedJsCss',
      ),
    ),
    'Magento\\Sales\\Api\\RefundOrderInterface' => NULL,
    'Magento\\Sales\\Model\\RefundOrder' => 
    array (
      'refundOrderAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\ReturnToStockOrder',
      ),
    ),
    'Magento\\Sales\\Api\\RefundInvoiceInterface' => NULL,
    'Magento\\Sales\\Model\\RefundInvoice' => 
    array (
      'refundInvoiceAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\ReturnToStockInvoice',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\RefundOrderInterface' => 
    array (
      'refundOrderValidationAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\Validation\\OrderRefundCreationArguments',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\RefundInvoiceInterface' => 
    array (
      'refundInvoiceValidationAfter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\SalesInventory\\Model\\Plugin\\Order\\Validation\\InvoiceRefundCreationArguments',
      ),
    ),
    'Magento\\MediaStorage\\Model\\File\\Storage\\Synchronization' => 
    array (
      'remoteMedia' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\RemoteStorage\\Plugin\\MediaStorage',
      ),
    ),
    'Magento\\Framework\\Image\\Adapter\\AdapterInterface' => NULL,
    'Magento\\Framework\\Image\\Adapter\\AbstractAdapter' => 
    array (
      'remoteImageFile' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\RemoteStorage\\Plugin\\Image',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Attribute\\AttributeInterface' => NULL,
    'Magento\\Eav\\Api\\Data\\AttributeInterface' => NULL,
    'Magento\\Framework\\Api\\MetadataObjectInterface' => NULL,
    'Magento\\Eav\\Model\\Entity\\Attribute\\AbstractAttribute' => NULL,
    'Magento\\Eav\\Model\\Entity\\Attribute' => NULL,
    'Magento\\Catalog\\Api\\Data\\ProductAttributeInterface' => NULL,
    'Magento\\Eav\\Model\\Entity\\Attribute\\ScopedAttributeInterface' => NULL,
    'Magento\\Catalog\\Api\\Data\\EavAttributeInterface' => NULL,
    'Magento\\Catalog\\Model\\ResourceModel\\Eav\\Attribute' => 
    array (
      'save_swatches_option_params' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\EavAttribute',
      ),
      'change_product_attribute' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Product\\Attribute',
      ),
      'invalidate_caches_after_attribute_save' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Plugin\\Catalog\\CacheInvalidate',
      ),
    ),
    'Magento\\LayeredNavigation\\Block\\Navigation\\FilterRendererInterface' => NULL,
    'Magento\\LayeredNavigation\\Block\\Navigation\\FilterRenderer' => 
    array (
      'swatches_layered_renderer' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\FilterRenderer',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductAttributeOptionManagementInterface' => NULL,
    'Magento\\Catalog\\Api\\ProductAttributeOptionUpdateInterface' => NULL,
    'Magento\\Catalog\\Model\\Product\\Attribute\\OptionManagement' => 
    array (
      'swatches_product_attribute_optionmanagement_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Plugin\\Eav\\Model\\Entity\\Attribute\\OptionManagement',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\ToOrder' => 
    array (
      'add_tax_to_order' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Model\\Quote\\ToOrderConverter',
      ),
    ),
    'Magento\\Quote\\Model\\Cart\\TotalsConverter' => 
    array (
      'add_tax_details' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Model\\Quote\\GrandTotalDetailsPlugin',
      ),
      'addGiftWrapInitialAmount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote\\GiftWrap',
      ),
      'vertex_calculation_message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\TotalsCalculationMessagePlugin',
      ),
    ),
    'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\DataProvider' => NULL,
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Listing\\DataProvider' => 
    array (
      'taxSettingsProvider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tax\\Plugin\\Ui\\DataProvider\\TaxSettings',
      ),
      'weeeSettingsProvider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Weee\\Plugin\\Ui\\DataProvider\\WeeeSettings',
      ),
      'wishlistSettingsDataProvider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Wishlist\\Plugin\\Ui\\DataProvider\\WishlistSettings',
      ),
    ),
    'Magento\\Webapi\\Model\\ServiceMetadata' => 
    array (
      'webapiServiceMetadataAsync' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiAsync\\Plugin\\ServiceMetadata',
      ),
    ),
    'Magento\\Framework\\Cache\\FrontendInterface' => NULL,
    'Magento\\Framework\\Cache\\Frontend\\Decorator\\Bare' => NULL,
    'Magento\\Framework\\Cache\\Frontend\\Decorator\\TagScope' => NULL,
    'Magento\\Webapi\\Model\\Cache\\Type\\Webapi' => 
    array (
      'webapiCacheAsync' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiAsync\\Plugin\\Cache\\Webapi',
      ),
    ),
    'Magento\\Webapi\\Controller\\Rest' => 
    array (
      'default_store_setter' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\FrontController\\Plugin\\DefaultStore',
      ),
      'webapiContorllerRestAsync' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiAsync\\Plugin\\ControllerRest',
      ),
      'configHash' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\Deploy\\Model\\Plugin\\ConfigChangeDetector',
      ),
    ),
    'Magento\\Webapi\\Model\\Config\\Converter' => 
    array (
      'webapiResourceSecurity' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\WebapiSecurity\\Model\\Plugin\\AnonymousResourceSecurity',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute\\RemoveProductAttributeData' => 
    array (
      'removeWeeAttributesData' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Weee\\Plugin\\Catalog\\ResourceModel\\Attribute\\RemoveProductWeeData',
      ),
    ),
    'Magento\\Wishlist\\Controller\\IndexInterface' => NULL,
    'Magento\\Catalog\\Controller\\Product\\View\\ViewInterface' => NULL,
    'Magento\\Wishlist\\Controller\\AbstractIndex' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'authentication' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Wishlist\\Controller\\Index\\Plugin',
      ),
    ),
    'Magento\\Checkout\\CustomerData\\Cart' => 
    array (
      'amazon_core_cart_section' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Amazon\\Core\\Plugin\\CartSection',
      ),
    ),
    'Magento\\Checkout\\Controller\\Cart' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Checkout\\Controller\\Cart\\Index' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'amazon_login_cart_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CartController',
      ),
    ),
    'Magento\\Checkout\\Controller\\Action' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Checkout\\Controller\\Onepage' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Checkout\\Controller\\Index\\Index' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'amazon_login_checkout_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CheckoutController',
      ),
    ),
    'Magento\\Customer\\Controller\\AccountInterface' => NULL,
    'Magento\\Customer\\Controller\\AbstractAccount' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Customer\\Controller\\Account\\Login' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'amazon_login_login_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\LoginController',
      ),
    ),
    'Magento\\Customer\\Controller\\Account\\Create' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'amazon_login_create_controller' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\CreateController',
      ),
    ),
    'Magento\\Sales\\Api\\OrderCustomerManagementInterface' => 
    array (
      'amazon_login_order_customer_service' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Login\\Plugin\\OrderCustomerManagement',
      ),
      'Ddg_CustomerManagementPlugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CustomerManagementPlugin',
      ),
    ),
    'Magento\\Checkout\\Api\\ShippingInformationManagementInterface' => 
    array (
      'amazon_payment_shipping_information_management' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\ShippingInformationManagement',
      ),
    ),
    'Magento\\Quote\\Api\\Data\\PaymentInterface' => 
    array (
      'amazon_payment_additional_information' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Amazon\\Payment\\Plugin\\AdditionalInformation',
      ),
    ),
    'Magento\\Payment\\Model\\MethodInterface' => NULL,
    'Magento\\Quote\\Api\\Data\\PaymentMethodInterface' => NULL,
    'Magento\\Payment\\Model\\Method\\AbstractMethod' => NULL,
    'Amazon\\Payment\\Model\\Method\\AmazonLoginMethod' => 
    array (
      'disable_amazon_payment_method' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'Amazon\\Payment\\Plugin\\DisableAmazonPaymentMethod',
      ),
    ),
    'Magento\\Quote\\Api\\PaymentMethodManagementInterface' => NULL,
    'Magento\\Quote\\Model\\PaymentMethodManagement' => 
    array (
      'confirm_order_reference_on_payment_details_save' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'Amazon\\Payment\\Plugin\\ConfirmOrderReference',
      ),
    ),
    'Magento\\Framework\\Webapi\\ErrorProcessor' => 
    array (
      'amazon_payment_webapi_error_processor' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\WebapiErrorProcessor',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Subscriber' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Subscriber\\NewAction' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'ddg_newsletter_email_capture' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\NewsletterEmailCapturePlugin',
      ),
    ),
    'Magento\\Customer\\Model\\EmailNotificationInterface' => 
    array (
      'ddg_customer_email_disabler' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CustomerEmailNotificationPlugin',
      ),
    ),
    'Magento\\Reports\\Model\\ResourceModel\\Product\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
      'ddg_reports_product_collection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\ReportsProductCollectionPlugin',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilder' => 
    array (
      'magetrend-pdf-transport-builder' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\Template\\TransportBuilder',
      ),
      'Ddg_TransportBuilderPlugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\TransportBuilderPlugin',
      ),
      'mageplaza_mail_template_transport_builder' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Mageplaza\\Smtp\\Mail\\Template\\TransportBuilder',
      ),
    ),
    'Magento\\Framework\\Mail\\MessageInterface' => 
    array (
      'dotmailer_message_plugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\MessagePlugin',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Manage' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Manage\\Index' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'dotmailer_newsletter_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\NewsletterManageIndexPlugin',
      ),
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite\\Save' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'dotmailer_url_rewrite_save_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\UrlRewriteSavePlugin',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\SalesRule\\Api\\CouponRepositoryInterface' => 
    array (
      'coupon_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CouponPlugin',
      ),
    ),
    'Magento\\Framework\\Model\\ResourceModel\\Db\\Collection\\AbstractCollection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\SalesRule\\Model\\ResourceModel\\Coupon\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
      'ddg_generated_for_email_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CouponCollectionPlugin',
      ),
    ),
    'Magento\\SalesRule\\Model\\Utility' => 
    array (
      'ddg_coupon_expired_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\CouponExpiredPlugin',
      ),
    ),
    'Magento\\CatalogInventory\\Api\\StockRegistryInterface' => 
    array (
      'ddg_stock_update_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\StockUpdatePlugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Controller\\Ajax\\Emailcapture' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'ddg_chat_emailcapture_plugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Chat\\Plugin\\EmailcapturePlugin',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\Save' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'ddg_new_shipment_plugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\Order\\Shipment\\NewShipmentPlugin',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\AddTrack' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'ddg_update_shipment_plugin' => 
      array (
        'sortOrder' => 3,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\Order\\Shipment\\ShipmentUpdatePlugin',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Model\\Cron\\Cleaner' => 
    array (
      'ddg_sms_cron_cleaner_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\CronCleanerPlugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Console\\Command\\Provider\\TaskProvider' => 
    array (
      'ddg_sms_task_provider_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\TaskProviderPlugin',
      ),
    ),
    'Magento\\Checkout\\Block\\Checkout\\LayoutProcessor' => 
    array (
      'ddg_sms_international_telephone_layout_processor_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Dotdigitalgroup\\Sms\\Plugin\\Block\\Checkout\\LayoutProcessor',
      ),
    ),
    'Klarna\\Core\\Helper\\KlarnaConfig' => 
    array (
      'klarnaKpKlarnaConfig' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Klarna\\Kp\\Plugin\\Helper\\KlarnaConfigPlugin',
      ),
    ),
    'Klarna\\Core\\Model\\Checkout\\Orderline\\Collector' => 
    array (
      'klarnaKpCollector' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Klarna\\Kp\\Plugin\\Model\\Checkout\\Orderline\\CollectorPlugin',
      ),
    ),
    'Magento\\Payment\\Helper\\Data' => 
    array (
      'klarnaKpPaymentData' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Klarna\\Kp\\Plugin\\Payment\\Helper\\DataPlugin',
      ),
    ),
    'Klarna\\Core\\Model\\Config' => 
    array (
      'klarnaKpConfig' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Klarna\\Kp\\Plugin\\Model\\ConfigPlugin',
      ),
    ),
    'Magento\\QuoteGraphQl\\Model\\Cart\\Payment\\AdditionalDataProviderPool' => 
    array (
      'klarnaKpGraphQlAdditionalDataProviderPool' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Klarna\\KpGraphQl\\Plugin\\Model\\Cart\\Payment\\AdditionalDataProviderPoolPlugin',
      ),
    ),
    'Magento\\Framework\\GraphQl\\Query\\ResolverInterface' => NULL,
    'Magento\\QuoteGraphQl\\Model\\Resolver\\AvailablePaymentMethods' => 
    array (
      'klarnaKpGraphQlAvailablePaymentMethods' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Klarna\\KpGraphQl\\Plugin\\Model\\Resolver\\AvailablePaymentMethodsPlugin',
      ),
    ),
    'Magento\\Backend\\Block\\Template' => NULL,
    'Magento\\Sales\\Block\\Adminhtml\\Items\\AbstractItems' => NULL,
    'Magento\\Sales\\Block\\Adminhtml\\Items\\Renderer\\DefaultRenderer' => NULL,
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Items\\Renderer\\DefaultRenderer' => 
    array (
      'mageworx_order_editor_update_default_item_renderer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Block\\Sales\\Adminhtml\\Order\\View\\Items\\DefaultRenderer',
      ),
    ),
    'Magento\\Bundle\\Block\\Adminhtml\\Sales\\Order\\View\\Items\\Renderer' => 
    array (
      'mageworx_order_editor_update_default_item_renderer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Block\\Sales\\Adminhtml\\Order\\View\\Items\\DefaultRenderer',
      ),
      'mageworx_order_editor_update_bundle_item_renderer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\Block\\Sales\\Adminhtml\\Order\\View\\Items\\BundleRenderer',
      ),
    ),
    'Magento\\Sales\\Model\\Spi\\ShipmentTrackResourceInterface' => NULL,
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Shipment\\Track' => 
    array (
      'mageworx_ordersgrid_sync_order_shipment_track' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\Spi\\OrderAddressResourceInterface' => NULL,
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Address' => 
    array (
      'mageworx_ordersgrid_sync_order_address' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\Spi\\OrderItemResourceInterface' => NULL,
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Item' => 
    array (
      'mageworx_ordersgrid_sync_order_item' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Tax' => 
    array (
      'mageworx_ordersgrid_sync_order_tax' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\Synchronize',
      ),
    ),
    'Magento\\CatalogUrlRewrite\\Observer\\ProductProcessUrlRewriteRemovingObserver' => 
    array (
      'mw_product_delete_plugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'MageWorx\\SeoRedirects\\Plugin\\ProductProcessUrlRewriteRemovingObserverPlugin',
      ),
    ),
    'Magento\\Sitemap\\Model\\Observer' => 
    array (
      'aroundScheduledGenerateSitemaps' => 
      array (
        'sortOrder' => 1,
        'instance' => 'MageWorx\\XmlSitemap\\Plugin\\CronGenerateSitemap',
      ),
    ),
    'Magento\\Framework\\Data\\Form\\Element\\Factory' => 
    array (
      'md_base_form_additional_elements' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Base\\Plugin\\Magento\\Framework\\Data\\Form\\Element\\Factory',
      ),
    ),
    'Magento\\Checkout\\Model\\ShippingInformationManagement' => 
    array (
      'mpdt_saveDeliveryInformation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\DeliveryTime\\Model\\Plugin\\Checkout\\ShippingInformationManagement',
      ),
      'amazon_payment_shipping_information_management' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Amazon\\Payment\\Plugin\\ShippingInformationManagement',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Kernel' => 
    array (
      'mplayerProcessRequest' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\LayeredNavigation\\Plugin\\PageCache\\ProcessRequest',
      ),
    ),
    'Magento\\Customer\\Model\\Address' => 
    array (
      'setShouldIgnoreValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address',
      ),
    ),
    'Magento\\Checkout\\Api\\TotalsInformationManagementInterface' => NULL,
    'Magento\\Checkout\\Model\\TotalsInformationManagement' => 
    array (
      'saveShipingMethodOnCalculate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Checkout\\TotalsInformationManagement',
      ),
    ),
    'Magento\\Quote\\Api\\Data\\CartInterface' => NULL,
    'Magento\\Quote\\Model\\Quote' => 
    array (
      'getItemById_Osc' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote',
      ),
    ),
    'Magento\\Checkout\\Helper\\Data' => 
    array (
      'osc_allow_guest_checkout' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Checkout\\Data',
      ),
    ),
    'Magento\\Eav\\Model\\Attribute\\Data\\AbstractData' => 
    array (
      'mposc_bypass_validate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Eav\\Model\\Attribute\\AbstractData',
      ),
    ),
    'Magento\\Customer\\Model\\Attribute\\Data\\Postcode' => 
    array (
      'mposc_bypass_validate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Eav\\Model\\Attribute\\AbstractData',
      ),
      'mposc_bypass_validate_postcode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Eav\\Model\\Attribute\\Postcode',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteValidator' => 
    array (
      'mposc_set_should_ignore_validation_quote' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote\\QuoteValidator',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\Price' => NULL,
    'Magento\\Bundle\\Block\\Catalog\\Product\\Price' => NULL,
    'Magento\\Bundle\\Block\\Catalog\\Product\\View\\Type\\Bundle\\Option' => 
    array (
      'mposc_append_item_option' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Catalog\\Product\\View\\Type\\Bundle\\OptionPlugin',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Options\\AbstractOptions' => 
    array (
      'mposc_append_item_layout' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Catalog\\Product\\View\\Options\\AbstractOptions',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\ToOrderAddress' => 
    array (
      'mposc_convert_quote_address_to_order_address' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address\\ConvertQuoteAddressToOrderAddress',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\CustomAttributeListInterface' => NULL,
    'Magento\\Quote\\Model\\Quote\\Address\\CustomAttributeList' => 
    array (
      'mposc_add_custom_field_to_address' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Quote\\Address\\CustomAttributeList',
      ),
    ),
    'Magento\\Customer\\Model\\Address\\CustomAttributeListInterface' => NULL,
    'Magento\\Customer\\Model\\Address\\CustomAttributeList' => 
    array (
      'mposc_add_custom_field_to_customer' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Customer\\Address\\CustomAttributeList',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilderByStore' => 
    array (
      'mpsmtp_appTransportBuilder' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Smtp\\Plugin\\Message',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\AbstractPdf' => NULL,
    'Magento\\Sales\\Model\\Order\\Pdf\\Invoice' => 
    array (
      'magetrend-invoice-pdf' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Invoice',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Creditmemo' => 
    array (
      'magetrend-creditmemo-pdf' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Creditmemo',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Shipment' => 
    array (
      'magetrend-shipment-pdf' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Shipment',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintAction' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'magetrend-guest-order-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintAction',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintInvoice' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'magetrend-guest-invoice-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintInvoice',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintCreditmemo' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'magetrend-guest-creditmemo-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintCreditmemo',
      ),
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintShipment' => 
    array (
      'storeCheck' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Store\\App\\Action\\Plugin\\StoreCheck',
        'disabled' => true,
      ),
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'magetrend-guest-shipment-pdf-replace-print' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Guest\\PrintShipment',
      ),
    ),
    'Magento\\Framework\\Mail\\TransportInterfaceFactory' => 
    array (
      'magetrend-pdf-transport-interface' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\TransportInterfaceFactory',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Total\\DefaultTotal' => 
    array (
      'magetrend-pdf-default-total' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Model\\Order\\Pdf\\Total\\DefaultTotal',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order\\AbstractMassAction' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\Pdfinvoices' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'magetrend-pdf-mass-pdf-invoice-list' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractInvoice\\Pdfinvoices',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\PrintAction' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'magetrend-pdf-mass-pdf-invoice' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractInvoice\\PrintAction',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\Pdfshipments' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'magetrend-pdf-mass-pdf-shipment-list' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractShipment\\Pdfshipments',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\PrintAction' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'magetrend-pdf-mass-pdf-shipment' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractShipment\\PrintAction',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\Pdfcreditmemos' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'magetrend-pdf-mass-pdf-creditmemo-list' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractCreditmemo\\Pdfcreditmemos',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\PrintAction' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'magetrend-pdf-mass-pdf-creditmemo' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Sales\\Controller\\Adminhtml\\AbstractCreditmemo\\PrintAction',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Framework\\Mail\\MailMessageInterface' => NULL,
    'Magento\\Framework\\Mail\\Message' => 
    array (
      'magetrend-pdf-message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\Message',
      ),
      'dotmailer_message_plugin' => 
      array (
        'sortOrder' => 1,
        'disabled' => false,
        'instance' => 'Dotdigitalgroup\\Email\\Plugin\\MessagePlugin',
      ),
    ),
    'Magento\\Framework\\Mail\\MimeMessageInterface' => NULL,
    'Magento\\Framework\\Mail\\MimeMessage' => 
    array (
      'magetrend-pdf-mime-message' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\Framework\\Mail\\MimeMessage',
      ),
    ),
    'Magento\\MediaGalleryIntegration\\Plugin\\SaveImageInformation' => 
    array (
      'magetrend-241-bugfix' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magetrend\\PdfTemplates\\Plugin\\MediaGalleryIntegration\\Plugin\\SaveImageInformation',
      ),
    ),
    'Magento\\Framework\\App\\Request\\ValidatorInterface' => NULL,
    'Magento\\Framework\\App\\Request\\CsrfValidator' => 
    array (
      'csrf_validator_skip_psigate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'PL\\Psigate\\Plugin\\CsrfValidatorSkip',
      ),
    ),
    'Magento\\Framework\\View\\Asset\\Minification' => 
    array (
      'braintreeExcludeFromMinification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'PayPal\\Braintree\\Plugin\\ExcludeFromMinification',
      ),
    ),
    'Magento\\Framework\\Pricing\\Render\\PriceBoxRenderInterface' => NULL,
    'Magento\\Framework\\Pricing\\Render\\PriceBox' => NULL,
    'Magento\\Catalog\\Pricing\\Render\\FinalPriceBox' => 
    array (
      'Sw_Dailydeals_change_template' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Smartwave\\Dailydeals\\Plugin\\FinalPricePlugin',
      ),
    ),
    'Vertex\\Utility\\SoapClientFactory' => 
    array (
      'registerLastCreatedClient' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\SoapClientFactoryPlugin',
      ),
    ),
    'Vertex\\Utility\\ServiceActionPerformerFactory' => 
    array (
      'useObjectManager' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\ServiceActionPerformerFactoryPlugin',
      ),
    ),
    'Magento\\Sales\\Api\\OrderAddressRepositoryInterface' => 
    array (
      'extensionAttributeVertexVatCountryCode' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\VatCountryCodeAttributePlugin',
      ),
    ),
    'Magento\\Tax\\Api\\TaxCalculationInterface' => 
    array (
      'vertexTaxCalculation' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\TaxCalculationPlugin',
      ),
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax' => 
    array (
      'apply_tax_class_id' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector',
      ),
      'vertexItemLevelMap' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CommonTaxCollectorPlugin',
      ),
      'vertexOrderLevelMap' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\TaxPlugin',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface' => 
    array (
      'vertex_custom_option_flex_field_db_handler' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomOptionFlexFieldExtensionAttributeHandler',
      ),
    ),
    'Magento\\Sales\\Api\\CreditmemoRepositoryInterface' => 
    array (
      'get_vertex_creditmemo_item_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CreditmemoRepositoryPlugin',
      ),
    ),
    'Magento\\Sales\\Api\\InvoiceRepositoryInterface' => 
    array (
      'get_vertex_invoice_item_attributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\InvoiceRepositoryPlugin',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\ListProduct' => 
    array (
      'add_product_object_to_image_data_array' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Model\\Plugin\\ProductImage',
      ),
      'yotpo_yotpo_catalog_block_product_listproduct_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Catalog\\Block\\Product\\ListProduct',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\ReviewRendererInterface' => NULL,
    'Magento\\Review\\Block\\Product\\ReviewRenderer' => 
    array (
      'yotpo_yotpo_review_block_product_reviewrenderer_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Review\\Block\\Product\\ReviewRenderer',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Details' => 
    array (
      'yotpo_yotpo_catalog_block_product_view_details_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Catalog\\Block\\Product\\View\\Details',
      ),
    ),
    'Magento\\Framework\\Session\\SessionManagerInterface' => NULL,
    'Magento\\Framework\\Session\\SessionManager' => NULL,
    'Magento\\Backend\\Model\\Auth\\StorageInterface' => NULL,
    'Magento\\Backend\\Model\\Auth\\Session' => 
    array (
      'security_admin_sessions_prolong' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\AuthSession',
      ),
    ),
    'Magento\\Eav\\Model\\Adminhtml\\System\\Config\\Source\\Inputtype' => 
    array (
      'append_compatible_input_types' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Plugin\\Eav\\System\\Config\\Source\\InputtypePlugin',
      ),
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth\\Login' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'security_login_form' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\LoginController',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\User\\Model\\UserValidationRules' => 
    array (
      'user_expiration_validator' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\UserValidationRules',
      ),
    ),
    'Magento\\Backend\\Block\\Widget' => NULL,
    'Magento\\Backend\\Block\\Widget\\Form' => NULL,
    'Magento\\Backend\\Block\\Widget\\Form\\Generic' => NULL,
    'Magento\\User\\Block\\User\\Edit\\Tab\\Main' => 
    array (
      'user_expiration_user_form_field' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Security\\Model\\Plugin\\AdminUserForm',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Action\\Full' => 
    array (
      'invalidate_pagecache_after_full_reindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\Indexer\\Category\\Product\\Execute',
      ),
    ),
    'Magento\\Eav\\Api\\AttributeSetRepositoryInterface' => 
    array (
      'remove_products' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Catalog\\Plugin\\Model\\AttributeSetRepository\\RemoveProducts',
      ),
    ),
    'Magento\\Catalog\\Model\\ProductLink\\Search' => 
    array (
      'processOutOfStockProducts' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogInventory\\Model\\Plugin\\ProductSearch',
      ),
    ),
    'Magento\\Rule\\Model\\AbstractModel' => NULL,
    'Magento\\CatalogRule\\Api\\Data\\RuleInterface' => NULL,
    'Magento\\CatalogRule\\Model\\Rule' => 
    array (
      'addVariationsToProductRule' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\CatalogRule\\Model\\Rule\\ConfigurableProductHandler',
      ),
      'configurableChildValidation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\CatalogRule\\Model\\Rule\\Validation',
      ),
    ),
    'Magento\\Catalog\\Api\\Data\\CategoryInterface' => NULL,
    'Magento\\Catalog\\Api\\Data\\CategoryTreeInterface' => NULL,
    'Magento\\Catalog\\Model\\Category' => 
    array (
      'apply_after_products_assign' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\Category',
      ),
    ),
    'Magento\\Customer\\Model\\Group' => 
    array (
      'reindex_after_delete_customer_group' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRule\\Plugin\\Indexer\\CustomerGroup',
      ),
    ),
    'Magento\\Catalog\\Block\\Adminhtml\\Form' => NULL,
    'Magento\\Catalog\\Block\\Adminhtml\\Product\\Edit\\Tab\\Attributes' => 
    array (
      'product_form_url_key_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\Catalog\\Block\\Adminhtml\\Product\\Edit\\Tab\\Attributes',
      ),
    ),
    'Magento\\Bundle\\Block\\Adminhtml\\Catalog\\Product\\Edit\\Tab\\Attributes' => 
    array (
      'product_form_url_key_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogUrlRewrite\\Plugin\\Catalog\\Block\\Adminhtml\\Product\\Edit\\Tab\\Attributes',
      ),
      'bundle_msrp_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Msrp\\Plugin\\Bundle\\Block\\Adminhtml\\Catalog\\Product\\Edit\\Tab\\Attributes',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\AbstractCreate' => NULL,
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar' => 
    array (
      'GroupedProduct' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\GroupedProduct\\Block\\Adminhtml\\Order\\Create\\Sidebar',
      ),
      'Bundle' => 
      array (
        'sortOrder' => 200,
        'instance' => 'Magento\\Bundle\\Block\\Adminhtml\\Order\\Create\\Sidebar',
      ),
      'configurable' => 
      array (
        'sortOrder' => 200,
        'instance' => 'Magento\\ConfigurableProduct\\Block\\Adminhtml\\Order\\Create\\Sidebar',
      ),
    ),
    'Magento\\Bundle\\Model\\ResourceModel\\Selection\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
      'Bundle' => 
      array (
        'sortOrder' => 60,
        'instance' => 'Magento\\Bundle\\Model\\ResourceModel\\Selection\\Plugin\\Collection',
      ),
    ),
    'Magento\\Framework\\View\\TemplateEngineFactory' => 
    array (
      'debug_hints' => 
      array (
        'sortOrder' => 10,
        'instance' => 'Magento\\Developer\\Model\\TemplateEngine\\Plugin\\DebugHints',
      ),
    ),
    'Magento\\Catalog\\Block\\Adminhtml\\Product\\Attribute\\Edit\\Tab\\Front' => 
    array (
      'search_weigh' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogSearch\\Block\\Plugin\\FrontTabPlugin',
      ),
    ),
    'Magento\\Sales\\Model\\AdminOrder\\Product\\Quote\\Initializer' => 
    array (
      'sales_adminorder_quote_initializer_plugin' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\GroupedProduct\\Model\\Sales\\AdminOrder\\Product\\Quote\\Plugin\\Initializer',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Builder' => 
    array (
      'configurable' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Controller\\Adminhtml\\Product\\Builder\\Plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Validator' => 
    array (
      'configurable' => 
      array (
        'sortOrder' => 50,
        'instance' => 'Magento\\ConfigurableProduct\\Model\\Product\\Validator\\Plugin',
      ),
    ),
    'Magento\\Sales\\Api\\Data\\InvoiceInterface' => NULL,
    'Magento\\Sales\\Model\\Order\\Invoice' => 
    array (
      'update_configurable_product_total_qty' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\ConfigurableProduct\\Plugin\\Model\\Order\\Invoice\\UpdateConfigurableProductTotalQty',
      ),
    ),
    'Magento\\Backend\\Block\\Widget\\Button\\ToolbarInterface' => 
    array (
      'login_as_customer_button_toolbar' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAdminUi\\Plugin\\Button\\ToolbarPlugin',
      ),
    ),
    'Magento\\Customer\\Model\\Customer\\DataProviderWithDefaultAddresses' => 
    array (
      'login_as_customer_customer_data_provider_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\DataProviderWithDefaultAddressesPlugin',
      ),
      'ShowVertexCustomerAttributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerDataProviderPlugin',
      ),
    ),
    'Magento\\Customer\\Model\\Metadata\\Form' => 
    array (
      'login_as_customer_customer_data_validate_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\CustomerDataValidatePlugin',
      ),
    ),
    'Magento\\LoginAsCustomerAdminUi\\Ui\\Customer\\Component\\Button\\DataProvider' => 
    array (
      'login_as_customer_button_data_provider_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\LoginAsCustomerAssistance\\Plugin\\LoginAsCustomerButtonDataProviderPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\ImageUploader' => 
    array (
      'save_category_image' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryCatalogIntegration\\Plugin\\SaveBaseCategoryImageInformation',
      ),
    ),
    'Magento\\Ui\\Component\\Form\\Element\\DataType\\Media\\OpenDialogUrl' => 
    array (
      'new_media_gallery_open_dialog_url' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryIntegration\\Plugin\\NewMediaGalleryOpenDialogUrl',
      ),
    ),
    'Magento\\Framework\\File\\Uploader' => 
    array (
      'save_asset_image' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\MediaGalleryIntegration\\Plugin\\SaveImageInformation',
      ),
    ),
    'Magento\\Backend\\Block\\Widget\\ContainerInterface' => NULL,
    'Magento\\Backend\\Block\\Widget\\Button\\ContextInterface' => NULL,
    'Magento\\Backend\\Block\\Widget\\Container' => NULL,
    'Magento\\Cms\\Block\\Adminhtml\\Wysiwyg\\Images\\Content' => 
    array (
      'add_search_button' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdobeStockImageAdminUi\\Plugin\\AddSearchButton',
      ),
    ),
    'Magento\\MediaGalleryUi\\Model\\GetDetailsByAssetId' => 
    array (
      'add_adobe_stock_image_details_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdobeStockImageAdminUi\\Plugin\\AddAdobeStockImageDetailsPlugin',
      ),
    ),
    'Magento\\MediaGalleryUi\\Ui\\Component\\Listing\\Columns\\Source\\Options' => 
    array (
      'add_adobe_stock_source_option_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AdobeStockImageAdminUi\\Plugin\\AddAdobeStockSourceOptionPlugin',
      ),
    ),
    'Magento\\Framework\\Mview\\ActionInterface' => NULL,
    'Magento\\CatalogRule\\Model\\Indexer\\AbstractIndexer' => 
    array (
      'cache_cleaner_after_reindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Indexer\\Model\\Indexer\\CacheCleaner',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\Product\\ProductRuleIndexer' => 
    array (
      'cache_cleaner_after_reindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Indexer\\Model\\Indexer\\CacheCleaner',
      ),
      'productRuleReindex' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\CatalogRuleConfigurable\\Plugin\\CatalogRule\\Model\\Indexer\\ProductRuleReindex',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\SearchInterface' => NULL,
    'Magento\\Config\\Model\\Config\\Structure' => 
    array (
      'paypal_system_configuration' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Model\\Config\\StructurePlugin',
      ),
    ),
    'Magento\\Config\\Model\\Config\\StructureElementInterface' => NULL,
    'Magento\\Config\\Model\\Config\\Structure\\ElementInterface' => NULL,
    'Magento\\Config\\Model\\Config\\Structure\\AbstractElement' => NULL,
    'Magento\\Config\\Model\\Config\\Structure\\Element\\Field' => 
    array (
      'paypal_system_configuration_field' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Model\\Config\\Structure\\Element\\FieldPlugin',
      ),
    ),
    'Magento\\Backend\\Block\\Store\\Switcher' => 
    array (
      'paypal_store_switcher' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Paypal\\Block\\Adminhtml\\Store\\SwitcherPlugin',
      ),
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed\\Index' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Rss\\App\\Action\\Plugin\\BackendAuthentication',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute\\Save' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'save_swatches_frontend_input' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Swatches\\Controller\\Adminhtml\\Product\\Attribute\\Plugin\\Save',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'Magento\\AdminNotification\\Model\\ResourceModel\\System\\Message\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\AdminNotification\\Model\\ResourceModel\\System\\Message\\Collection\\Synchronized' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
      'afterToArray' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AsynchronousOperations\\Model\\ResourceModel\\System\\Message\\Collection\\Synchronized\\Plugin',
      ),
    ),
    'Magento\\AdminNotification\\Ui\\Component\\DataProvider\\DataProvider' => 
    array (
      'afterGetMeta' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\AsynchronousOperations\\Ui\\Component\\AdminNotification\\Plugin',
      ),
    ),
    'Magento\\Widget\\Model\\Widget' => 
    array (
      'change_widget_placeholder' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Tinymce3\\Model\\Plugin\\Widget',
      ),
    ),
    'Magento\\Cms\\Model\\Page\\DataProvider' => 
    array (
      'google_optimizer_cms_page_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GoogleOptimizer\\Model\\Plugin\\Cms\\Page\\DataProvider',
      ),
      'mageworx_custom_canonical_cms_page_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoBase\\Plugin\\CustomCanonicalFormUpdate\\AddToCmsPageFormPlugin',
      ),
    ),
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Form\\NewCategoryDataProvider' => 
    array (
      'google_optimizer_product_new_category_data_provider' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\GoogleOptimizer\\Model\\Plugin\\Catalog\\Product\\Category\\DataProvider',
      ),
    ),
    'Magento\\Shipping\\Block\\Adminhtml\\Order\\Packaging' => 
    array (
      'usps' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Usps\\Block\\Adminhtml\\Order\\Packaging\\Plugin\\DisplayGirth',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\AbstractOrder' => NULL,
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Info' => 
    array (
      'mageworx_order_editor_add_device_info_to_customer_account_block' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrdersBase\\Plugin\\Block\\Sales\\Adminhtml\\Order\\View\\Info',
      ),
      'klarnaCoreValidationInfo' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Klarna\\Core\\Plugin\\Sales\\Block\\Adminhtml\\Order\\View\\InfoPlugin',
      ),
    ),
    'Magento\\InventoryConfigurationApi\\Model\\IsSourceItemManagementAllowedForProductTypeInterface' => 
    array (
      'mageworx_ordereditor_disable_msi' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableMSI',
      ),
    ),
    'Magento\\InventorySalesApi\\Api\\IsProductSalableInterface' => 
    array (
      'mageworx_ordereditor_disable_inventory_detection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableInventoryDetectionPlugin',
      ),
    ),
    'Magento\\InventorySales\\Plugin\\StockState\\CheckQuoteItemQtyPlugin' => 
    array (
      'mageworx_ordereditor_disable_qty_validation' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableQtyValidationPlugin',
      ),
    ),
    'Magento\\CatalogInventory\\Observer\\QuantityValidatorObserver' => 
    array (
      'mageworx_ordereditor_disable_qty_validation_for_backorders' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\DisableBackordersQtyValidationPlugin',
      ),
    ),
    'Magento\\GiftCardAccount\\Model\\Plugin\\TotalsCollector' => 
    array (
      'mageworx_order_editor_void_giftcard_totals' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\BeforeCollectTotalsPlugin',
      ),
    ),
    'Magento\\CustomerBalance\\Model\\Total\\Quote\\Customerbalance' => 
    array (
      'mageworx_order_editor_disable_storecredit_totals_collect' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\CollectCustomerBalancePlugin',
      ),
    ),
    'Magento\\Payment\\Model\\SaleOperationInterface' => NULL,
    'Magento\\Payment\\Model\\Method\\Adapter' => 
    array (
      'mageworx_ordereditor_authorizenet_capture_actual_amount_correct_amount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\AuthorizeNet\\SetActualAmountBeforeCapturePlugin',
      ),
    ),
    'Magento\\AuthorizenetAcceptjs\\Gateway\\Request\\CaptureDataBuilder' => 
    array (
      'mageworx_ordereditor_authorizenet_capture_actual_amount_add_amount' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\OrderEditor\\Plugin\\AuthorizeNet\\CaptureActualAmountPlugin',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order' => 
    array (
      'eventDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\EventDispatchPlugin',
      ),
      'actionFlagNoDispatch' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Framework\\App\\Action\\Plugin\\ActionFlagNoDispatchPlugin',
      ),
      'designLoader' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\LoadDesignPlugin',
      ),
      'customerNotification' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Customer\\Model\\Plugin\\CustomerNotification',
      ),
      'themeRegistrationFromFilesystem' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Model\\Theme\\Plugin\\Registration',
      ),
      'synchronizeOrderGrid' => 
      array (
        'sortOrder' => 10,
        'disabled' => false,
        'instance' => 'MageWorx\\OrdersGrid\\Plugin\\SynchronizeOrderGrid',
      ),
      'adminMassactionKey' => 
      array (
        'sortOrder' => 11,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\MassactionKey',
      ),
      'adminAuthentication' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\Authentication',
      ),
      'adminLoadDesign' => 
      array (
        'sortOrder' => 101,
        'instance' => 'Magento\\Backend\\App\\Action\\Plugin\\LoadDesignPlugin',
      ),
    ),
    'MageWorx\\SeoReports\\Model\\ConfigInterface' => NULL,
    'MageWorx\\SeoReports\\Model\\Config\\AbstractConfig' => NULL,
    'MageWorx\\SeoReports\\Model\\Config\\Product' => 
    array (
      'addSeoNameToProductReportConfig' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoXTemplates\\Plugin\\AddSeoNameToProductReportAfterPlugin',
      ),
    ),
    'MageWorx\\SeoReports\\Model\\Config\\Category' => 
    array (
      'addSeoNameToCategoryReportConfig' => 
      array (
        'sortOrder' => 0,
        'instance' => 'MageWorx\\SeoXTemplates\\Plugin\\AddSeoNameToCategoryReportAfterPlugin',
      ),
    ),
    'Magento\\Backend\\Model\\View\\Result\\Page' => 
    array (
      'updateBodyClass' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Smartwave\\Porto\\Plugin\\UpdateBodyClass',
      ),
      'magedelight_base_modify_setactivemenu' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Base\\Plugin\\Magento\\Backend\\Model\\View\\Result\\Page',
      ),
    ),
    'Magento\\Backend\\Model\\Menu\\Item' => 
    array (
      'md_common_menu_item_newtab' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Base\\Plugin\\Magento\\Backend\\Model\\Menu\\Item',
      ),
      'md_monerisca_menu_item_newtab' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magedelight\\Monerisca\\Plugin\\Magento\\Backend\\Model\\Menu\\Item',
      ),
    ),
    'Magento\\Framework\\Config\\Data\\Scoped' => NULL,
    'Magento\\Config\\Model\\Config\\Structure\\Data' => 
    array (
      'mageplaza_module_activate' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Core\\Model\\Config\\Structure\\Data',
      ),
    ),
    'Magento\\Backend\\Model\\Menu\\Builder\\AbstractCommand' => 
    array (
      'mageplaza_move_menu' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Core\\Plugin\\MoveMenu',
      ),
    ),
    'Magento\\Backend\\Block\\Widget\\Tab\\TabInterface' => NULL,
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Tab\\Info' => 
    array (
      'mp_delivery_information' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\DeliveryTime\\Block\\Adminhtml\\Plugin\\OrderViewTabInfo',
      ),
      'osc_additional_content' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Block\\Adminhtml\\Plugin\\OrderViewTabInfo',
      ),
    ),
    'Magento\\Framework\\View\\Element\\UiComponentInterface' => NULL,
    'Magento\\Ui\\Component\\AbstractComponent' => NULL,
    'Magento\\Ui\\Component\\Listing\\Columns\\ColumnInterface' => NULL,
    'Magento\\Ui\\Component\\Listing\\Columns\\Column' => 
    array (
      'osc_customer_grid' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Mageplaza\\Osc\\Model\\Plugin\\Ui\\Component\\Listing\\Column',
      ),
    ),
    'Magento\\Framework\\Api\\Search\\SearchResultInterface' => NULL,
    'Magento\\Framework\\Api\\SearchResultsInterface' => NULL,
    'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\SearchResult' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Grid\\Collection' => 
    array (
      'currentPageDetection' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Magento\\Theme\\Plugin\\Data\\Collection',
      ),
      'braintreeSalesOrderGrid' => 
      array (
        'sortOrder' => 0,
        'instance' => 'PayPal\\Braintree\\Plugin\\SalesOrderGridPlugin',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Element\\AbstractComposite' => NULL,
    'Magento\\Config\\Model\\Config\\Structure\\Element\\Group' => 
    array (
      'ConfigGroupPlugin' => 
      array (
        'sortOrder' => 1,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\GroupPlugin',
      ),
    ),
    'Magento\\Customer\\Model\\Customer\\DataProvider' => 
    array (
      'ShowVertexCustomerAttributes' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Vertex\\Tax\\Model\\Plugin\\CustomerDataProviderPlugin',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Form\\AbstractForm' => NULL,
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Form\\Address' => 
    array (
      'vertex_addressvalidation_admin_order_form' => 
      array (
        'sortOrder' => 100,
        'instance' => 'Vertex\\AddressValidation\\Plugin\\Adminhtml\\AddBlockToOrderCreateForm',
      ),
    ),
    'Magento\\Backend\\Block\\Widget\\Tabs' => NULL,
    'Magento\\Backend\\Block\\Dashboard\\Grids' => 
    array (
      'yotpo_yotpo_backend_block_dashboard_grids_plugin' => 
      array (
        'sortOrder' => 0,
        'instance' => 'Yotpo\\Yotpo\\Plugin\\Backend\\Block\\Dashboard\\Grids',
      ),
    ),
  ),
  2 => 
  array (
    'Magento\\Framework\\DB\\Adapter\\AdapterInterface_commit___self' => 
    array (
      4 => 
      array (
        0 => 'execute_commit_callbacks',
      ),
    ),
    'Magento\\Framework\\DB\\Adapter\\AdapterInterface_rollBack___self' => 
    array (
      4 => 
      array (
        0 => 'execute_commit_callbacks',
      ),
    ),
    'Magento\\Framework\\App\\Response\\Http_sendResponse___self' => 
    array (
      1 => 
      array (
        0 => 'genericHeaderPlugin',
      ),
    ),
    'Magento\\Framework\\App\\Response\\Http_sendVary___self' => 
    array (
      2 => 'magetrend-network-error-fix',
    ),
    'Magento\\Framework\\App\\ActionInterface_execute___self' => 
    array (
      1 => 
      array (
        0 => 'storeCheck',
        1 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Framework\\App\\ActionInterface_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Framework\\Url\\SecurityInfo_isSecure___self' => 
    array (
      2 => 'storeUrlSecurityInfo',
    ),
    'Magento\\Framework\\Url\\RouteParamsResolver_setRouteParams___self' => 
    array (
      1 => 
      array (
        0 => 'storeUrlRouteParamsResolver',
      ),
    ),
    'Magento\\Framework\\Url\\ScopeInterface_getBaseUrl___self' => 
    array (
      4 => 
      array (
        0 => 'urlSignature',
      ),
    ),
    'Magento\\Store\\Model\\Store_getBaseUrl___self' => 
    array (
      4 => 
      array (
        0 => 'urlSignature',
      ),
    ),
    'Magento\\Store\\Model\\Store_save___self' => 
    array (
      4 => 
      array (
        0 => 'themeDesignConfigGridIndexerStore',
      ),
    ),
    'Magento\\Store\\Model\\Store_delete___self' => 
    array (
      4 => 
      array (
        0 => 'themeDesignConfigGridIndexerStore',
      ),
    ),
    'Magento\\Framework\\App\\Config\\Initial\\Converter_convert___self' => 
    array (
      4 => 
      array (
        0 => 'cron_system_config_initial_converter_plugin',
      ),
    ),
    'Magento\\Framework\\App\\FrontControllerInterface_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'default_store_setter',
        1 => 'configHash',
      ),
    ),
    'Magento\\Framework\\App\\FrontController_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'default_store_setter',
        1 => 'storeCookieValidate',
        2 => 'install',
        3 => 'configHash',
      ),
    ),
    'Magento\\Cms\\Model\\Wysiwyg\\Images\\Storage_deleteFile___self' => 
    array (
      4 => 
      array (
        0 => 'media_gallery_image_remove_metadata_after_wysiwyg',
      ),
    ),
    'Magento\\Cms\\Model\\Wysiwyg\\Images\\Storage_deleteDirectory___self' => 
    array (
      4 => 
      array (
        0 => 'media_gallery_image_remove_metadata_after_wysiwyg',
      ),
    ),
    'Magento\\AdvancedPricingImportExport\\Model\\Import\\AdvancedPricing_saveAdvancedPricing___self' => 
    array (
      4 => 
      array (
        0 => 'invalidateAdvancedPriceIndexerOnImport',
      ),
    ),
    'Magento\\AdvancedPricingImportExport\\Model\\Import\\AdvancedPricing_deleteAdvancedPricing___self' => 
    array (
      4 => 
      array (
        0 => 'invalidateAdvancedPriceIndexerOnImport',
      ),
    ),
    'Magento\\Theme\\Model\\DesignConfigRepository_save___self' => 
    array (
      4 => 
      array (
        0 => 'save_design_settings_event_dispatching',
      ),
    ),
    'Magento\\Theme\\Model\\DesignConfigRepository_delete___self' => 
    array (
      4 => 
      array (
        0 => 'save_design_settings_event_dispatching',
      ),
    ),
    'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\CollectionFactory_getReport___self' => 
    array (
      1 => 
      array (
        0 => 'mageworx_ordersgrid_change_grid_collection',
      ),
    ),
    'Magento\\Store\\Model\\Website_save___self' => 
    array (
      2 => 'themeDesignConfigGridIndexerWebsite',
    ),
    'Magento\\Store\\Model\\Website_delete___self' => 
    array (
      4 => 
      array (
        0 => 'themeDesignConfigGridIndexerWebsite',
      ),
      2 => 'reindex_customer_grid_after_website_remove',
    ),
    'Magento\\Store\\Model\\Website_delete_reindex_customer_grid_after_website_remove' => 
    array (
      4 => 
      array (
        0 => 'reindex_after_delete_website',
      ),
    ),
    'Magento\\Store\\Model\\Group_delete___self' => 
    array (
      4 => 
      array (
        0 => 'themeDesignConfigGridIndexerStoreGroup',
      ),
    ),
    'Magento\\Config\\App\\Config\\Source\\DumpConfigSourceAggregated_get___self' => 
    array (
      4 => 
      array (
        0 => 'designConfigTheme',
      ),
    ),
    'Magento\\Framework\\Data\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Consumer\\Config\\CompositeReader_read___self' => 
    array (
      4 => 
      array (
        0 => 'queueConfigPlugin',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Publisher\\Config\\CompositeReader_read___self' => 
    array (
      4 => 
      array (
        0 => 'queueConfigPlugin',
      ),
    ),
    'Magento\\Framework\\MessageQueue\\Topology\\Config\\CompositeReader_read___self' => 
    array (
      4 => 
      array (
        0 => 'queueConfigPlugin',
      ),
    ),
    'Magento\\Framework\\Amqp\\Bulk\\Exchange_enqueue___self' => 
    array (
      1 => 
      array (
        0 => 'amqpStoreIdFieldForAmqpBulkExchange',
      ),
    ),
    'Magento\\AsynchronousOperations\\Model\\MassConsumerEnvelopeCallback_execute___self' => 
    array (
      2 => 'amqpStoreIdFieldForAsynchronousOperationsMassConsumerEnvelopeCallback',
    ),
    'Magento\\Framework\\App\\Config\\Value_save___self' => 
    array (
      4 => 
      array (
        0 => 'admin_system_config_media_gallery_renditions',
        1 => 'admin_system_config_adobe_stock_save_plugin',
      ),
    ),
    'Magento\\Framework\\App\\Config\\Value_afterSave___self' => 
    array (
      4 => 
      array (
        0 => 'webapiResourceSecurityCacheInvalidate',
      ),
    ),
    'Magento\\Authorization\\Model\\Role_save___self' => 
    array (
      4 => 
      array (
        0 => 'updateRoleUsersAcl',
      ),
    ),
    'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute_getStoreLabelsByAttributeId___self' => 
    array (
      2 => 'storeLabelCaching',
    ),
    'Magento\\Eav\\Model\\Entity\\AbstractEntity_save___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\AbstractEntity_delete___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
      ),
    ),
    'Magento\\Framework\\Data\\Collection\\AbstractDb_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Collection\\AbstractCollection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Collection\\VersionControl\\AbstractCollection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Customer\\Model\\ResourceModel\\Customer\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Customer\\Model\\ResourceModel\\Customer\\Collection_addAttributeToFilter___self' => 
    array (
      2 => 'amazon_login_customer_collection',
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_save___self' => 
    array (
      2 => 'transactionWrapper',
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_save_transactionWrapper' => 
    array (
      4 => 
      array (
        0 => 'login_as_customer_customer_repository_plugin',
        1 => 'update_newsletter_subscription_on_customer_update',
      ),
      2 => 'extensionAttributeVertexCustomerCode',
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_deleteById___self' => 
    array (
      2 => 'update_newsletter_subscription_on_customer_update',
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_delete___self' => 
    array (
      4 => 
      array (
        0 => 'update_newsletter_subscription_on_customer_update',
      ),
      2 => 'extensionAttributeVertexCustomerCode',
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_getById___self' => 
    array (
      4 => 
      array (
        0 => 'update_newsletter_subscription_on_customer_update',
        1 => 'extensionAttributeVertexCustomerCode',
        2 => 'extensionAttributeVertexCustomerCountry',
        3 => 'amazon_login_customer_repository',
      ),
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_getList___self' => 
    array (
      4 => 
      array (
        0 => 'update_newsletter_subscription_on_customer_update',
        1 => 'extensionAttributeVertexCustomerCode',
        2 => 'extensionAttributeVertexCustomerCountry',
      ),
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexCustomerCode',
        1 => 'extensionAttributeVertexCustomerCountry',
        2 => 'amazon_login_customer_repository',
      ),
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_deleteById_update_newsletter_subscription_on_customer_update' => 
    array (
      2 => 'extensionAttributeVertexCustomerCode',
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_delete_extensionAttributeVertexCustomerCode' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexCustomerCountry',
      ),
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_deleteById_extensionAttributeVertexCustomerCode' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexCustomerCountry',
      ),
    ),
    'Magento\\Customer\\Api\\CustomerRepositoryInterface_save_extensionAttributeVertexCustomerCode' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexCustomerCountry',
      ),
    ),
    'Magento\\Directory\\Model\\AllowedCountries_getAllowedCountries___self' => 
    array (
      1 => 
      array (
        0 => 'customerAllowedCountries',
      ),
    ),
    'Magento\\PageCache\\Observer\\FlushFormKey_execute___self' => 
    array (
      2 => 'customerFlushFormKey',
    ),
    'Magento\\Customer\\Model\\AccountManagement_initiatePasswordReset___self' => 
    array (
      1 => 
      array (
        0 => 'security_check_customer_password_reset_attempt',
      ),
    ),
    'Magento\\Customer\\Model\\AccountManagement_createAccount___self' => 
    array (
      1 => 
      array (
        0 => 'mz_osc_newaccount',
      ),
    ),
    'Magento\\Customer\\Model\\AccountManagement_isEmailAvailable___self' => 
    array (
      4 => 
      array (
        0 => 'mpsmtp_account_management',
      ),
    ),
    'Magento\\Customer\\Model\\AccountManagement_authenticate___self' => 
    array (
      1 => 
      array (
        0 => 'AccountManagementPlugin',
      ),
    ),
    'Magento\\Indexer\\Model\\Config\\Data_get___self' => 
    array (
      4 => 
      array (
        0 => 'indexerCategoryFlatConfigGet',
        1 => 'indexerProductFlatConfigGet',
      ),
    ),
    'Magento\\Indexer\\Model\\Processor_updateMview___self' => 
    array (
      4 => 
      array (
        0 => 'page-cache-indexer-reindex-clean-cache',
      ),
    ),
    'Magento\\Indexer\\Model\\Processor_reindexAllInvalid___self' => 
    array (
      4 => 
      array (
        0 => 'page-cache-indexer-reindex-clean-cache',
      ),
    ),
    'Magento\\Framework\\Indexer\\ActionInterface_executeFull___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
    ),
    'Magento\\Framework\\Indexer\\ActionInterface_executeList___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
    ),
    'Magento\\Framework\\Indexer\\ActionInterface_executeRow___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
    ),
    'Magento\\Catalog\\Model\\Product_load___self' => 
    array (
      4 => 
      array (
        0 => 'catalogInventoryAfterLoad',
      ),
    ),
    'Magento\\Catalog\\Model\\Product_getIdentities___self' => 
    array (
      4 => 
      array (
        0 => 'product_identities_extender',
        1 => 'cms',
        2 => 'add_bundle_parent_identities',
      ),
    ),
    'Magento\\Catalog\\Model\\Product_getMediaAttributes___self' => 
    array (
      4 => 
      array (
        0 => 'exclude_swatch_attribute',
      ),
    ),
    'Magento\\ImportExport\\Model\\Import_importSource___self' => 
    array (
      4 => 
      array (
        0 => 'catalogProductFlatIndexerImport',
        1 => 'invalidatePriceIndexerOnImport',
        2 => 'invalidateStockIndexerOnImport',
        3 => 'invalidateEavIndexerOnImport',
        4 => 'invalidateProductCategoryIndexerOnImport',
        5 => 'invalidateCategoryProductIndexerOnImport',
        6 => 'reindex_after_import',
      ),
    ),
    'Magento\\Customer\\Model\\ResourceModel\\Visitor_clean___self' => 
    array (
      4 => 
      array (
        0 => 'catalogLog',
        1 => 'reportLog',
      ),
    ),
    'Magento\\Catalog\\Model\\Category\\DataProvider_getDefaultMetaData___self' => 
    array (
      4 => 
      array (
        0 => 'set_page_layout_default_value',
      ),
    ),
    'Magento\\Catalog\\Model\\Category\\DataProvider_getAttributesMeta___self' => 
    array (
      4 => 
      array (
        0 => 'category_ui_form_url_key_plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Category\\DataProvider_prepareMeta___self' => 
    array (
      4 => 
      array (
        0 => 'google_optimizer_category_data_provider',
        1 => 'mageworxAddCategoryCustomAttributes',
      ),
    ),
    'Magento\\Catalog\\Model\\Category\\DataProvider_getMeta___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_custom_canonical_category_data_provider',
      ),
    ),
    'Magento\\Theme\\Block\\Html\\Topmenu_getHtml___self' => 
    array (
      1 => 
      array (
        0 => 'catalogTopmenu',
      ),
    ),
    'Magento\\Theme\\Block\\Html\\Topmenu_getIdentities___self' => 
    array (
      1 => 
      array (
        0 => 'catalogTopmenu',
      ),
    ),
    'Magento\\Theme\\Block\\Html\\Topmenu_getCacheKeyInfo___self' => 
    array (
      4 => 
      array (
        0 => 'catalogTopmenu',
      ),
    ),
    'Magento\\Framework\\Mview\\View\\StateInterface_setStatus___self' => 
    array (
      4 => 
      array (
        0 => 'setStatusForMview',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Website_delete___self' => 
    array (
      4 => 
      array (
        0 => 'invalidatePriceIndexerOnWebsite',
        1 => 'categoryProductWebsiteAfterDelete',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Website_save___self' => 
    array (
      4 => 
      array (
        0 => 'invalidatePriceIndexerOnWebsite',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Store_save___self' => 
    array (
      4 => 
      array (
        0 => 'storeViewResourceAroundSave',
        1 => 'catalogProductFlatIndexerStore',
        2 => 'categoryStoreAroundSave',
        3 => 'productAttributesStoreViewSave',
        4 => 'catalogsearchFulltextIndexerStoreView',
        5 => 'store_plugin',
        6 => 'update_cms_url_rewrites_after_store_save',
      ),
      1 => 
      array (
        0 => 'store_plugin',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Store_delete___self' => 
    array (
      4 => 
      array (
        0 => 'categoryStoreAroundSave',
        1 => 'catalogsearchFulltextIndexerStoreView',
        2 => 'store_plugin',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Group_save___self' => 
    array (
      4 => 
      array (
        0 => 'storeGroupResourceAroundSave',
        1 => 'catalogProductFlatIndexerStoreGroup',
        2 => 'categoryStoreGroupAroundSave',
        3 => 'storeGroupResourceAroundBeforeSave',
        4 => 'catalogsearchFulltextIndexerStoreGroup',
        5 => 'group_plugin',
      ),
    ),
    'Magento\\Store\\Model\\ResourceModel\\Group_delete___self' => 
    array (
      4 => 
      array (
        0 => 'categoryStoreGroupAroundSave',
        1 => 'catalogsearchFulltextIndexerStoreGroup',
      ),
    ),
    'Magento\\Customer\\Api\\GroupRepositoryInterface_save___self' => 
    array (
      2 => 'invalidatePriceIndexerOnCustomerGroup',
    ),
    'Magento\\Customer\\Api\\GroupRepositoryInterface_deleteById___self' => 
    array (
      4 => 
      array (
        0 => 'invalidatePriceIndexerOnCustomerGroup',
      ),
    ),
    'Magento\\Eav\\Model\\Entity\\Attribute\\Set_save___self' => 
    array (
      1 => 
      array (
        0 => 'invalidateEavIndexerOnAttributeSetSave',
      ),
      4 => 
      array (
        0 => 'invalidateEavIndexerOnAttributeSetSave',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\TypeTransitionManager_processProduct___self' => 
    array (
      2 => 'downloadable_product_transition',
    ),
    'Magento\\Catalog\\Model\\Product\\TypeTransitionManager_processProduct_downloadable_product_transition' => 
    array (
      2 => 'configurable_product_transition',
    ),
    'Magento\\CatalogInventory\\Model\\Config\\Backend\\AbstractValue_save___self' => 
    array (
      4 => 
      array (
        0 => 'admin_system_config_media_gallery_renditions',
        1 => 'admin_system_config_adobe_stock_save_plugin',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Config\\Backend\\AbstractValue_afterSave___self' => 
    array (
      4 => 
      array (
        0 => 'webapiResourceSecurityCacheInvalidate',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Config\\Backend\\ShowOutOfStock_save___self' => 
    array (
      4 => 
      array (
        0 => 'admin_system_config_media_gallery_renditions',
        1 => 'admin_system_config_adobe_stock_save_plugin',
        2 => 'showOutOfStockValueChanged',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Config\\Backend\\ShowOutOfStock_afterSave___self' => 
    array (
      4 => 
      array (
        0 => 'webapiResourceSecurityCacheInvalidate',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Config_getAttributesUsedInListing___self' => 
    array (
      2 => 'productListingAttributesCaching',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Config_getAttributesUsedForSortBy___self' => 
    array (
      2 => 'productListingAttributesCaching',
    ),
    'Magento\\Eav\\Model\\Entity\\Attribute\\Backend\\AbstractBackend_validate___self' => 
    array (
      2 => 'attributeValidation',
    ),
    'Magento\\Eav\\Model\\Entity\\Attribute\\Backend\\AbstractBackend_validate_attributeValidation' => 
    array (
      2 => 'ConfigurableProduct::skipValidation',
    ),
    'Magento\\Sales\\Api\\OrderItemRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'get_gift_message',
        1 => 'vertex_commodity_code_order_item_repository',
      ),
    ),
    'Magento\\Sales\\Api\\OrderItemRepositoryInterface_delete___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_order_item_repository',
      ),
    ),
    'Magento\\Sales\\Api\\OrderItemRepositoryInterface_getList___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_order_item_repository',
      ),
    ),
    'Magento\\Sales\\Api\\OrderItemRepositoryInterface_save___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_order_item_repository',
      ),
    ),
    'Magento\\Eav\\Model\\ResourceModel\\ReadSnapshot_execute___self' => 
    array (
      4 => 
      array (
        0 => 'catalogReadSnapshot',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Item\\ToOrderItem_convert___self' => 
    array (
      1 => 
      array (
        0 => 'copy_quote_files_to_order',
      ),
      4 => 
      array (
        0 => 'append_bundle_data_to_order',
        1 => 'gift_message_quote_item_conversion',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper_initializeFromData___self' => 
    array (
      4 => 
      array (
        0 => 'weeeAttributeOptionsProcess',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper_mergeProductOptions___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_custom_option_flex_field_after_save_initialization',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Initialization\\Helper_initialize___self' => 
    array (
      4 => 
      array (
        0 => 'product_save_rewrites_history_plugin',
        1 => 'configurable',
        2 => 'Bundle',
        3 => 'updateConfigurations',
        4 => 'Downloadable',
        5 => 'cleanConfigurationTmpImages',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Repository_getCustomAttributesMetadata___self' => 
    array (
      4 => 
      array (
        0 => 'filterCustomAttribute',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\AbstractProduct_getImage___self' => 
    array (
      1 => 
      array (
        0 => 'add_product_object_to_image_data_array',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View_getImage___self' => 
    array (
      1 => 
      array (
        0 => 'add_product_object_to_image_data_array',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View_getQuantityValidators___self' => 
    array (
      4 => 
      array (
        0 => 'quantityValidators',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Action_updateAttributes___self' => 
    array (
      4 => 
      array (
        0 => 'ReindexUpdatedProducts',
        1 => 'quoteProductMassChange',
        2 => 'catalogsearchFulltextMassAction',
        3 => 'invalidate_pagecache_after_update_product_attributes',
        4 => 'price_plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Action_updateWebsites___self' => 
    array (
      4 => 
      array (
        0 => 'catalogsearchFulltextMassAction',
        1 => 'invalidate_pagecache_after_update_product_attributes',
      ),
    ),
    'Magento\\Framework\\App\\Action\\AbstractAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'storeCheck',
        1 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Framework\\App\\Action\\AbstractAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Framework\\App\\Action\\Action_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Framework\\App\\Action\\Action_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Backend\\App\\AbstractAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Backend\\App\\AbstractAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Backend\\App\\AbstractAction_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Backend\\App\\AbstractAction_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Backend\\App\\Action_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Backend\\App\\Action_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Backend\\App\\Action_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Backend\\App\\Action_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute\\Save_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute\\Save_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
      2 => 'massAction',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute\\Save_execute_massAction' => 
    array (
      4 => 
      array (
        0 => 'Ddg_UpdateProductAttribute_MassActionPlugin',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute\\Save_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Action\\Attribute\\Save_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\AbstractResource_save___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\AbstractResource_delete___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Category_save___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
        1 => 'update_url_path_for_different_stores',
      ),
      2 => 'catalogsearchFulltextCategory',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Category_delete___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
        1 => 'fulltext_search_indexer',
      ),
      2 => 'mw_category_delete_plugin',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Category_changeParent___self' => 
    array (
      4 => 
      array (
        0 => 'category_move_plugin',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\StorageInterface_replace___self' => 
    array (
      4 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\StorageInterface_deleteByData___self' => 
    array (
      1 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\Storage\\AbstractStorage_replace___self' => 
    array (
      4 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\Storage\\AbstractStorage_deleteByData___self' => 
    array (
      1 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\Storage\\DbStorage_replace___self' => 
    array (
      4 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\UrlRewrite\\Model\\Storage\\DbStorage_deleteByData___self' => 
    array (
      1 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\CatalogUrlRewrite\\Model\\Storage\\DbStorage_replace___self' => 
    array (
      4 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\CatalogUrlRewrite\\Model\\Storage\\DbStorage_deleteByData___self' => 
    array (
      1 => 
      array (
        0 => 'storage_plugin',
      ),
    ),
    'Magento\\CatalogUrlRewrite\\Model\\Storage\\DbStorage_findOneByData___self' => 
    array (
      2 => 'dynamic_storage_plugin',
    ),
    'Magento\\CatalogUrlRewrite\\Model\\Storage\\DbStorage_findAllByData___self' => 
    array (
      2 => 'dynamic_storage_plugin',
    ),
    'Magento\\Framework\\Search\\Request\\Config\\FilesystemReader_read___self' => 
    array (
      4 => 
      array (
        0 => 'productAttributesDynamicFields',
        1 => 'catalogSearchDynamicFields',
      ),
    ),
    'Magento\\Framework\\View\\Model\\Layout\\Merge_getDbUpdateString___self' => 
    array (
      2 => 'widget-layout-update-plugin',
    ),
    'Magento\\Quote\\Api\\CartRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_order_editor_add_edit_in_progress_extension_attribute',
        1 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Api\\CartRepositoryInterface_getForCustomer___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Api\\CartRepositoryInterface_getActive___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Api\\CartRepositoryInterface_getActiveForCustomer___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository_get___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_order_editor_add_edit_in_progress_extension_attribute',
        1 => 'multishipping_quote_repository',
        2 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository_getList___self' => 
    array (
      4 => 
      array (
        0 => 'multishipping_quote_repository',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository_save___self' => 
    array (
      1 => 
      array (
        0 => 'multishipping_quote_repository',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository_getForCustomer___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository_getActive___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteRepository_getActiveForCustomer___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_payment_quote_repository',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address_exportCustomerAddress___self' => 
    array (
      4 => 
      array (
        0 => 'mposc_convert_quote_address_to_customer_address',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product_save___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
        1 => 'update_quote_items_after_product_save',
      ),
      2 => 'catalogsearchFulltextProduct',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product_delete___self' => 
    array (
      4 => 
      array (
        0 => 'clean_cache',
        1 => 'clean_quote_items_after_product_delete',
      ),
      2 => 'catalogsearchFulltextProduct',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product_save_catalogsearchFulltextProduct' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_product_resource_model',
        1 => 'apply_catalog_rules_after_product_save',
      ),
      1 => 
      array (
        0 => 'reload_attributes',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product_delete_catalogsearchFulltextProduct' => 
    array (
      2 => 'reload_attributes',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product_delete_reload_attributes' => 
    array (
      1 => 
      array (
        0 => 'cleanups_wishlist_item_after_product_delete',
      ),
    ),
    'Magento\\MediaGallerySynchronizationApi\\Model\\ImportFilesComposite_execute___self' => 
    array (
      1 => 
      array (
        0 => 'createMediaGalleryThumbnails',
      ),
    ),
    'Magento\\Cms\\Model\\ResourceModel\\Page_delete___self' => 
    array (
      2 => 'mw_cms_url_rewrite_plugin',
      4 => 
      array (
        0 => 'mw_cms_url_rewrite_plugin',
      ),
    ),
    'Magento\\Cms\\Model\\ResourceModel\\Page_save___self' => 
    array (
      1 => 
      array (
        0 => 'mw_cms_url_rewrite_plugin',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\View_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\View_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Creditmemo_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Creditmemo_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Creditmemo_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\Creditmemo_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Creditmemo_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\History_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\History_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\History_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Invoice_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Invoice_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Invoice_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\Invoice_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Invoice_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-order-pdf-replace-print',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintAction_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintCreditmemo_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintCreditmemo_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintCreditmemo_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintCreditmemo_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-creditmemo-pdf-replace-print',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintCreditmemo_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintInvoice_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintInvoice_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintInvoice_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintInvoice_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-invoice-pdf-replace-print',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintInvoice_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintShipment_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\PrintShipment_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\PrintShipment_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintShipment_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-shipment-pdf-replace-print',
    ),
    'Magento\\Sales\\Controller\\Order\\PrintShipment_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Reorder_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Reorder_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Reorder_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\Reorder_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Reorder_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Shipment_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\AbstractController\\Shipment_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Shipment_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\Shipment_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\Shipment_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\View_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Order\\View_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Sales\\Controller\\Order\\View_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order_save___self' => 
    array (
      2 => 'mageworx_ordersgrid_sync_order',
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Invoice_save___self' => 
    array (
      2 => 'mageworx_ordersgrid_sync_order_invoice',
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Shipment_save___self' => 
    array (
      2 => 'mageworx_ordersgrid_sync_order_shipment',
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Handler\\Address_process___self' => 
    array (
      4 => 
      array (
        0 => 'addressUpdate',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Converter_convert___self' => 
    array (
      4 => 
      array (
        0 => 'cron_backend_config_structure_converter_plugin',
      ),
    ),
    'Magento\\Framework\\App\\RouterInterface_match___self' => 
    array (
      4 => 
      array (
        0 => 'csp_aware_plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Backend\\Price_validate___self' => 
    array (
      2 => 'attributeValidation',
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Backend\\Price_validate_attributeValidation' => 
    array (
      2 => 'ConfigurableProduct::skipValidation',
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Backend\\Price_validate_ConfigurableProduct::skipValidation' => 
    array (
      2 => 'bundle',
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\Backend\\Price_validate_bundle' => 
    array (
      2 => 'configurable',
    ),
    'Magento\\Sales\\Model\\Order\\Item_getQtyToCancel___self' => 
    array (
      4 => 
      array (
        0 => 'bundle',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Item_isProcessingAvailable___self' => 
    array (
      4 => 
      array (
        0 => 'bundle',
      ),
    ),
    'Magento\\Integration\\Api\\IntegrationServiceInterface_create___self' => 
    array (
      4 => 
      array (
        0 => 'webapiIntegrationService',
      ),
    ),
    'Magento\\Integration\\Api\\IntegrationServiceInterface_update___self' => 
    array (
      4 => 
      array (
        0 => 'webapiIntegrationService',
      ),
    ),
    'Magento\\Integration\\Api\\IntegrationServiceInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'webapiIntegrationService',
      ),
    ),
    'Magento\\Integration\\Api\\IntegrationServiceInterface_delete___self' => 
    array (
      4 => 
      array (
        0 => 'webapiIntegrationService',
      ),
    ),
    'Magento\\User\\Model\\User_save___self' => 
    array (
      4 => 
      array (
        0 => 'revokeTokensFromInactiveAdmins',
      ),
    ),
    'Magento\\Customer\\Model\\Customer_save___self' => 
    array (
      4 => 
      array (
        0 => 'revokeTokensFromInactiveCustomers',
      ),
    ),
    'Magento\\Customer\\Model\\Customer_sendNewAccountEmail___self' => 
    array (
      2 => 'ddg_customer_sendNewAccountEmail_disabler',
    ),
    'Magento\\Catalog\\Model\\Product\\CartConfiguration_isProductConfigured___self' => 
    array (
      2 => 'Downloadable',
    ),
    'Magento\\Catalog\\Model\\Product\\CartConfiguration_isProductConfigured_Downloadable' => 
    array (
      2 => 'isProductConfigured',
    ),
    'Magento\\Catalog\\Model\\Product\\CartConfiguration_isProductConfigured_isProductConfigured' => 
    array (
      2 => 'configurable_product',
    ),
    'Magento\\Framework\\View\\Result\\Page_renderResult___self' => 
    array (
      1 => 
      array (
        0 => 'updateBodyClass',
      ),
    ),
    'Magento\\Checkout\\Block\\Cart\\LayoutProcessor_isStateActive___self' => 
    array (
      4 => 
      array (
        0 => 'checkout_cart_shipping_dhl',
        1 => 'checkout_cart_shipping_plugin',
      ),
    ),
    'Magento\\Checkout\\Block\\Cart\\LayoutProcessor_isCityActive___self' => 
    array (
      4 => 
      array (
        0 => 'checkout_cart_shipping_dhl',
      ),
    ),
    'Magento\\Customer\\Controller\\Ajax\\Login_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Customer\\Controller\\Ajax\\Login_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'captcha_validation',
    ),
    'Magento\\Checkout\\Block\\Cart\\Sidebar_getConfig___self' => 
    array (
      4 => 
      array (
        0 => 'login_captcha',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Product\\Category\\Action\\Rows_execute___self' => 
    array (
      4 => 
      array (
        0 => 'catalogsearchFulltextCategoryAssignment',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute_getStoreLabelsByAttributeId___self' => 
    array (
      2 => 'storeLabelCaching',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute_save___self' => 
    array (
      1 => 
      array (
        0 => 'catalogsearchFulltextIndexerAttribute',
      ),
      4 => 
      array (
        0 => 'catalogsearchFulltextIndexerAttribute',
      ),
      2 => 'catalogsearchAttributeSearchWeightCache',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute_delete___self' => 
    array (
      1 => 
      array (
        0 => 'catalogsearchFulltextIndexerAttribute',
      ),
      4 => 
      array (
        0 => 'catalogsearchFulltextIndexerAttribute',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute_save_catalogsearchAttributeSearchWeightCache' => 
    array (
      1 => 
      array (
        0 => 'updateElasticsearchIndexerMapping',
      ),
      4 => 
      array (
        0 => 'updateElasticsearchIndexerMapping',
        1 => 'invalidate_pagecache_after_attribute_save',
      ),
    ),
    'Magento\\Catalog\\Model\\Layer\\Search\\CollectionFilter_filter___self' => 
    array (
      4 => 
      array (
        0 => 'searchQuery',
      ),
    ),
    'Magento\\CatalogSearch\\Model\\Indexer\\Fulltext\\Action\\DataProvider_prepareProductIndex___self' => 
    array (
      1 => 
      array (
        0 => 'stockedProductsFilterPlugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Action\\Rows_execute___self' => 
    array (
      4 => 
      array (
        0 => 'catalogsearchFulltextProductAssignment',
      ),
    ),
    'Magento\\Framework\\Indexer\\Config\\DependencyInfoProvider_getIndexerIdsToRunBefore___self' => 
    array (
      4 => 
      array (
        0 => 'indexerDependencyUpdaterPlugin',
      ),
    ),
    'Magento\\Framework\\Indexer\\Config\\DependencyInfoProvider_getIndexerIdsToRunAfter___self' => 
    array (
      4 => 
      array (
        0 => 'indexerDependencyUpdaterPlugin',
      ),
    ),
    'Magento\\Email\\Model\\Template___call___self' => 
    array (
      1 => 
      array (
        0 => 'dotmailer_template_plugin',
      ),
      4 => 
      array (
        0 => 'dotmailer_template_plugin',
      ),
    ),
    'Magento\\Email\\Model\\Template_getData___self' => 
    array (
      4 => 
      array (
        0 => 'dotmailer_template_plugin',
      ),
    ),
    'Magento\\Email\\Model\\Template_beforeSave___self' => 
    array (
      4 => 
      array (
        0 => 'dotmailer_template_plugin',
      ),
    ),
    'Magento\\Email\\Model\\Template_beforeLoad___self' => 
    array (
      4 => 
      array (
        0 => 'dotmailer_template_plugin',
      ),
    ),
    'Magento\\Email\\Model\\Template_afterLoad___self' => 
    array (
      4 => 
      array (
        0 => 'dotmailer_template_plugin',
      ),
    ),
    'Magento\\Framework\\Mail\\TransportInterface_sendMessage___self' => 
    array (
      1 => 
      array (
        0 => 'WindowsSmtpConfig',
      ),
      2 => 'EmailDisable',
    ),
    'Magento\\Framework\\Mail\\TransportInterface_sendMessage_EmailDisable' => 
    array (
      2 => 'ddg_mail_transport',
    ),
    'Magento\\Framework\\Mail\\TransportInterface_sendMessage_ddg_mail_transport' => 
    array (
      2 => 'mageplaza_mail_transport',
    ),
    'Magento\\Shipping\\Block\\DataProviders\\Tracking\\DeliveryDateTitle_getTitle___self' => 
    array (
      4 => 
      array (
        0 => 'update_delivery_date_title',
        1 => 'ups_update_delivery_date_title',
      ),
    ),
    'Magento\\Shipping\\Block\\Tracking\\Popup_formatDeliveryDateTime___self' => 
    array (
      4 => 
      array (
        0 => 'update_delivery_date_value',
      ),
    ),
    'Magento\\Sales\\Api\\OrderRepositoryInterface_save___self' => 
    array (
      4 => 
      array (
        0 => 'save_gift_message',
        1 => 'save_order_tax',
        2 => 'mageworx_order_base_save_device_data',
        3 => 'vertex_commodity_code_order_item_order_save',
        4 => 'addVertexCustomerCountryToOrderAddress',
      ),
    ),
    'Magento\\Sales\\Api\\OrderRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'get_gift_message',
        1 => 'mageworx_order_base_get_device_data',
        2 => 'mposc_add_order_comment_to_order_api',
        3 => 'get_vertex_order_item_attributes',
      ),
    ),
    'Magento\\Sales\\Api\\OrderRepositoryInterface_getList___self' => 
    array (
      4 => 
      array (
        0 => 'get_gift_message',
        1 => 'mposc_add_order_comment_to_order_api',
        2 => 'get_vertex_order_item_attributes',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Identifier_getValue___self' => 
    array (
      4 => 
      array (
        0 => 'mplayerPagecacheIdentifier',
        1 => 'core-app-area-design-exception-plugin',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Cache_save___self' => 
    array (
      1 => 
      array (
        0 => 'fpc-type-plugin',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Cache_load___self' => 
    array (
      4 => 
      array (
        0 => 'fpc-type-plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Type_getOptionArray___self' => 
    array (
      4 => 
      array (
        0 => 'grouped_output',
        1 => 'configurable_output',
      ),
    ),
    'Magento\\Catalog\\Helper\\Product\\Configuration_getOptions___self' => 
    array (
      2 => 'grouped_options',
    ),
    'Magento\\Catalog\\Helper\\Product\\Configuration_getOptions_grouped_options' => 
    array (
      2 => 'configurable_product',
    ),
    'Magento\\Catalog\\Model\\Product\\Initialization\\Helper\\ProductLinks_initializeLinks___self' => 
    array (
      1 => 
      array (
        0 => 'GroupedProduct',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Link_saveProductLinks___self' => 
    array (
      4 => 
      array (
        0 => 'groupedProductLinkProcessor',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Link_deleteProductLink___self' => 
    array (
      2 => 'groupedProductLinkProcessor',
    ),
    'Magento\\GroupedProduct\\Model\\Product\\Type\\Grouped_prepareForCartAdvanced___self' => 
    array (
      4 => 
      array (
        0 => 'outOfStockFilter',
      ),
    ),
    'Magento\\GroupedProduct\\Model\\Product\\Type\\Grouped_getAssociatedProductCollection___self' => 
    array (
      4 => 
      array (
        0 => 'grouped_product_minimum_advertised_price',
      ),
    ),
    'Magento\\CatalogInventory\\Model\\Quote\\Item\\QuantityValidator\\Initializer\\Option_getStockItem___self' => 
    array (
      4 => 
      array (
        0 => 'configurable_product',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Admin\\Item_getSku___self' => 
    array (
      2 => 'configurable_product',
    ),
    'Magento\\Sales\\Model\\Order\\Admin\\Item_getName___self' => 
    array (
      2 => 'configurable_product',
    ),
    'Magento\\Sales\\Model\\Order\\Admin\\Item_getProductId___self' => 
    array (
      2 => 'configurable_product',
    ),
    'Magento\\Catalog\\Model\\Entity\\Product\\Attribute\\Group\\AttributeMapperInterface_map___self' => 
    array (
      2 => 'configurable_product',
    ),
    'Magento\\Catalog\\Api\\ProductRepositoryInterface_delete___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_product_repository',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_product_repository',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductRepositoryInterface_getById___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_product_repository',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductRepositoryInterface_getList___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_product_repository',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductRepositoryInterface_save___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_commodity_code_product_repository',
        1 => 'configurableProductSaveOptions',
      ),
      1 => 
      array (
        0 => 'configurableProductSaveOptions',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\AbstractView_getImage___self' => 
    array (
      1 => 
      array (
        0 => 'add_product_object_to_image_data_array',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Gallery_getImage___self' => 
    array (
      1 => 
      array (
        0 => 'add_product_object_to_image_data_array',
      ),
    ),
    'Magento\\ProductVideo\\Block\\Product\\View\\Gallery_getImage___self' => 
    array (
      1 => 
      array (
        0 => 'add_product_object_to_image_data_array',
      ),
    ),
    'Magento\\ProductVideo\\Block\\Product\\View\\Gallery_getOptionsMediaGalleryDataJson___self' => 
    array (
      4 => 
      array (
        0 => 'product_video_gallery',
      ),
    ),
    'Magento\\ConfigurableProduct\\Model\\Product\\Type\\Configurable_getUsedProductCollection___self' => 
    array (
      4 => 
      array (
        0 => 'add_swatch_attributes_to_configurable',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Pricing\\Renderer\\SalableResolver_isSalable___self' => 
    array (
      4 => 
      array (
        0 => 'configurable',
      ),
    ),
    'Magento\\SalesRule\\Model\\Rule\\Condition\\Product_validate___self' => 
    array (
      1 => 
      array (
        0 => 'apply_rule_on_configurable_children',
      ),
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector_mapItem___self' => 
    array (
      4 => 
      array (
        0 => 'apply_tax_class_id',
      ),
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector_mapItems___self' => 
    array (
      4 => 
      array (
        0 => 'vertexItemLevelMap',
      ),
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector_getShippingDataObject___self' => 
    array (
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector_mapAddress___self' => 
    array (
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\CommonTaxCollector_mapItemExtraTaxables___self' => 
    array (
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Config\\Model\\Config\\Backend\\Baseurl_save___self' => 
    array (
      4 => 
      array (
        0 => 'admin_system_config_media_gallery_renditions',
        1 => 'admin_system_config_adobe_stock_save_plugin',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Backend\\Baseurl_afterSave___self' => 
    array (
      4 => 
      array (
        0 => 'webapiResourceSecurityCacheInvalidate',
        1 => 'updateAnalyticsSubscription',
      ),
    ),
    'Magento\\Quote\\Model\\Cart\\CartTotalRepository_get___self' => 
    array (
      4 => 
      array (
        0 => 'multishipping_shipping_addresses',
        1 => 'coupon_label_plugin',
      ),
    ),
    'Magento\\Integration\\Model\\ConfigBasedIntegrationManager_processIntegrationConfig___self' => 
    array (
      4 => 
      array (
        0 => 'webapiSetup',
      ),
    ),
    'Magento\\Integration\\Model\\ConfigBasedIntegrationManager_processConfigBasedIntegrations___self' => 
    array (
      4 => 
      array (
        0 => 'webapiSetup',
      ),
    ),
    'Magento\\Backend\\Model\\Auth_logout___self' => 
    array (
      1 => 
      array (
        0 => 'login_as_customer_admin_logout',
        1 => 'security_admin_sessions_login',
      ),
    ),
    'Magento\\Backend\\Model\\Auth_login___self' => 
    array (
      4 => 
      array (
        0 => 'security_admin_sessions_login',
      ),
    ),
    'Magento\\Framework\\Api\\DataObjectHelper_populateWithArray___self' => 
    array (
      4 => 
      array (
        0 => 'add_allow_remote_shopping_assistance_to_customer',
      ),
    ),
    'Magento\\LoginAsCustomerApi\\Api\\AuthenticateCustomerBySecretInterface_execute___self' => 
    array (
      1 => 
      array (
        0 => 'process_shopping_cart',
      ),
    ),
    'Magento\\MediaGalleryApi\\Api\\DeleteAssetsByPathsInterface_execute___self' => 
    array (
      2 => 'remove_media_content_after_asset_is_removed_by_path',
    ),
    'Magento\\MediaGalleryApi\\Api\\DeleteAssetsByPathsInterface_execute_remove_media_content_after_asset_is_removed_by_path' => 
    array (
      4 => 
      array (
        0 => 'delete_renditions_on_assets_delete',
      ),
    ),
    'Magento\\MediaGalleryApi\\Api\\DeleteDirectoriesByPathsInterface_execute___self' => 
    array (
      2 => 'remove_media_content_after_asset_is_removed_by_directory_path',
    ),
    'Magento\\MediaGallerySynchronization\\Model\\Consume_execute___self' => 
    array (
      4 => 
      array (
        0 => 'synchronize_media_content',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\Processor_removeImage___self' => 
    array (
      4 => 
      array (
        0 => 'media_gallery_image_remove_metadata',
      ),
    ),
    'Magento\\Cms\\Model\\Wysiwyg\\Images\\GetInsertImageContent_execute___self' => 
    array (
      1 => 
      array (
        0 => 'set_rendition_path',
      ),
    ),
    'Magento\\MediaGallerySynchronizationApi\\Model\\CreateAssetFromFileInterface_execute___self' => 
    array (
      4 => 
      array (
        0 => 'addMetadataToAssetCreatedFromFile',
      ),
    ),
    'Magento\\Framework\\App\\MaintenanceMode_set___self' => 
    array (
      4 => 
      array (
        0 => 'amqp_maintenance_mode',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Collection\\AbstractCollection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\ConfigurableProduct\\Model\\ResourceModel\\Product\\Type\\Configurable\\Product\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\ConfigurableProduct\\Model\\ResourceModel\\Product\\Type\\Configurable\\Product\\Collection_load___self' => 
    array (
      1 => 
      array (
        0 => 'catalogRulePriceForConfigurableProduct',
      ),
    ),
    'Magento\\Framework\\App\\Http_catchException___self' => 
    array (
      1 => 
      array (
        0 => 'framework-http-newrelic',
      ),
    ),
    'Magento\\Framework\\App\\State_setAreaCode___self' => 
    array (
      4 => 
      array (
        0 => 'framework-state-newrelic',
      ),
    ),
    'Symfony\\Component\\Console\\Command\\Command_run___self' => 
    array (
      1 => 
      array (
        0 => 'newrelic-describe-commands',
      ),
    ),
    'Magento\\Framework\\Profiler\\Driver\\Standard\\Stat_start___self' => 
    array (
      1 => 
      array (
        0 => 'newrelic-describe-cronjobs',
      ),
    ),
    'Magento\\Framework\\Profiler\\Driver\\Standard\\Stat_stop___self' => 
    array (
      1 => 
      array (
        0 => 'newrelic-describe-cronjobs',
      ),
    ),
    'Magento\\Newsletter\\Model\\Subscriber_sendConfirmationSuccessEmail___self' => 
    array (
      2 => 'ddg_newsletter_disabler',
    ),
    'Magento\\Quote\\Model\\QuoteManagement_submit___self' => 
    array (
      1 => 
      array (
        0 => 'validate_purchase_order_number',
        1 => 'coupon_uses_increment_plugin',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Config_getProductAttributes___self' => 
    array (
      4 => 
      array (
        0 => 'append_sales_rule_keys_to_quote',
      ),
    ),
    'Magento\\Sales\\Model\\Service\\OrderService_cancel___self' => 
    array (
      4 => 
      array (
        0 => 'coupon_uses_decrement_plugin',
      ),
    ),
    'Magento\\Sales\\Api\\Data\\OrderPaymentInterface_getExtensionAttributes___self' => 
    array (
      4 => 
      array (
        0 => 'PaymentVaultExtensionAttributeOperations',
      ),
    ),
    'Magento\\Checkout\\Api\\PaymentInformationManagementInterface_savePaymentInformation___self' => 
    array (
      1 => 
      array (
        0 => 'ProcessPaymentVaultInformationManagement',
        1 => 'validate-agreements',
      ),
    ),
    'Magento\\Checkout\\Api\\PaymentInformationManagementInterface_savePaymentInformationAndPlaceOrder___self' => 
    array (
      1 => 
      array (
        0 => 'validate-agreements',
      ),
    ),
    'Magento\\Payment\\Model\\Checks\\Composite_isApplicable___self' => 
    array (
      4 => 
      array (
        0 => 'paypal_specification',
      ),
    ),
    'Magento\\Sales\\Model\\Order_canInvoice___self' => 
    array (
      4 => 
      array (
        0 => 'express_order_invoice',
      ),
    ),
    'Magento\\Sales\\Model\\Order_place___self' => 
    array (
      4 => 
      array (
        0 => 'admin-order-placement-comment',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\CanInvoice_validate___self' => 
    array (
      4 => 
      array (
        0 => 'express_order_invoice',
      ),
    ),
    'Magento\\Framework\\Session\\SessionStartChecker_check___self' => 
    array (
      4 => 
      array (
        0 => 'transparent_session_checker',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Payment_getExtensionAttributes___self' => 
    array (
      4 => 
      array (
        0 => 'PaymentVaultExtensionAttributeOperations',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Payment_accept___self' => 
    array (
      4 => 
      array (
        0 => 'paypal_transparent',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Payment_prependMessage___self' => 
    array (
      1 => 
      array (
        0 => 'amazon_pay_order_payment',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Payment_formatPrice___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_pay_order_payment',
      ),
    ),
    'Magento\\Quote\\Model\\AddressAdditionalDataProcessor_process___self' => 
    array (
      1 => 
      array (
        0 => 'persistent_remember_me_checkbox_processor',
      ),
    ),
    'Magento\\Customer\\CustomerData\\Customer_getSectionData___self' => 
    array (
      2 => 'section_data',
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\CreateHandler_execute___self' => 
    array (
      1 => 
      array (
        0 => 'external_video_media_entry_saver',
      ),
      4 => 
      array (
        0 => 'external_video_media_entry_saver',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Gallery\\ReadHandler_execute___self' => 
    array (
      4 => 
      array (
        0 => 'external_video_media_entry_reader',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Gallery_duplicate___self' => 
    array (
      4 => 
      array (
        0 => 'external_video_media_resource_backend',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Product\\Gallery_createBatchBaseSelect___self' => 
    array (
      4 => 
      array (
        0 => 'external_video_media_resource_backend',
      ),
    ),
    'Magento\\Checkout\\Api\\GuestPaymentInformationManagementInterface_savePaymentInformationAndPlaceOrder___self' => 
    array (
      1 => 
      array (
        0 => 'validate-guest-agreements',
      ),
      4 => 
      array (
        0 => 'guest_payment_no_commit_after_event_workaround',
      ),
    ),
    'Magento\\Framework\\View\\Asset\\MergeService_cleanMergedJsCss___self' => 
    array (
      4 => 
      array (
        0 => 'cleanMergedJsCss',
      ),
    ),
    'Magento\\Sales\\Model\\RefundOrder_execute___self' => 
    array (
      4 => 
      array (
        0 => 'refundOrderAfter',
      ),
    ),
    'Magento\\Sales\\Model\\RefundInvoice_execute___self' => 
    array (
      4 => 
      array (
        0 => 'refundInvoiceAfter',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\RefundOrderInterface_validate___self' => 
    array (
      4 => 
      array (
        0 => 'refundOrderValidationAfter',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Validation\\RefundInvoiceInterface_validate___self' => 
    array (
      4 => 
      array (
        0 => 'refundInvoiceValidationAfter',
      ),
    ),
    'Magento\\MediaStorage\\Model\\File\\Storage\\Synchronization_synchronize___self' => 
    array (
      1 => 
      array (
        0 => 'remoteMedia',
      ),
    ),
    'Magento\\Framework\\Image\\Adapter\\AbstractAdapter_open___self' => 
    array (
      1 => 
      array (
        0 => 'remoteImageFile',
      ),
    ),
    'Magento\\Framework\\Image\\Adapter\\AbstractAdapter_validateUploadFile___self' => 
    array (
      1 => 
      array (
        0 => 'remoteImageFile',
      ),
    ),
    'Magento\\Framework\\Image\\Adapter\\AbstractAdapter_watermark___self' => 
    array (
      1 => 
      array (
        0 => 'remoteImageFile',
      ),
    ),
    'Magento\\Framework\\Image\\Adapter\\AbstractAdapter_save___self' => 
    array (
      2 => 'remoteImageFile',
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Eav\\Attribute_beforeSave___self' => 
    array (
      1 => 
      array (
        0 => 'save_swatches_option_params',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Eav\\Attribute_afterSave___self' => 
    array (
      4 => 
      array (
        0 => 'save_swatches_option_params',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Eav\\Attribute_usesSource___self' => 
    array (
      4 => 
      array (
        0 => 'save_swatches_option_params',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Eav\\Attribute_save___self' => 
    array (
      4 => 
      array (
        0 => 'change_product_attribute',
        1 => 'invalidate_caches_after_attribute_save',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Eav\\Attribute_delete___self' => 
    array (
      4 => 
      array (
        0 => 'change_product_attribute',
      ),
    ),
    'Magento\\LayeredNavigation\\Block\\Navigation\\FilterRenderer_render___self' => 
    array (
      2 => 'swatches_layered_renderer',
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\OptionManagement_add___self' => 
    array (
      1 => 
      array (
        0 => 'swatches_product_attribute_optionmanagement_plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Attribute\\OptionManagement_update___self' => 
    array (
      1 => 
      array (
        0 => 'swatches_product_attribute_optionmanagement_plugin',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\ToOrder_convert___self' => 
    array (
      1 => 
      array (
        0 => 'add_tax_to_order',
      ),
      4 => 
      array (
        0 => 'add_tax_to_order',
      ),
    ),
    'Magento\\Quote\\Model\\Cart\\TotalsConverter_process___self' => 
    array (
      4 => 
      array (
        0 => 'add_tax_details',
      ),
      2 => 'addGiftWrapInitialAmount',
    ),
    'Magento\\Quote\\Model\\Cart\\TotalsConverter_process_addGiftWrapInitialAmount' => 
    array (
      2 => 'vertex_calculation_message',
    ),
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Listing\\DataProvider_getData___self' => 
    array (
      4 => 
      array (
        0 => 'taxSettingsProvider',
        1 => 'weeeSettingsProvider',
        2 => 'wishlistSettingsDataProvider',
      ),
    ),
    'Magento\\Webapi\\Model\\ServiceMetadata_getServicesConfig___self' => 
    array (
      4 => 
      array (
        0 => 'webapiServiceMetadataAsync',
      ),
    ),
    'Magento\\Webapi\\Model\\Cache\\Type\\Webapi_load___self' => 
    array (
      1 => 
      array (
        0 => 'webapiCacheAsync',
      ),
    ),
    'Magento\\Webapi\\Model\\Cache\\Type\\Webapi_save___self' => 
    array (
      1 => 
      array (
        0 => 'webapiCacheAsync',
      ),
    ),
    'Magento\\Webapi\\Model\\Cache\\Type\\Webapi_remove___self' => 
    array (
      1 => 
      array (
        0 => 'webapiCacheAsync',
      ),
    ),
    'Magento\\Webapi\\Controller\\Rest_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'default_store_setter',
        1 => 'webapiContorllerRestAsync',
        2 => 'configHash',
      ),
    ),
    'Magento\\Webapi\\Model\\Config\\Converter_convert___self' => 
    array (
      4 => 
      array (
        0 => 'webapiResourceSecurity',
      ),
    ),
    'Magento\\Catalog\\Model\\ResourceModel\\Attribute\\RemoveProductAttributeData_removeData___self' => 
    array (
      2 => 'removeWeeAttributesData',
    ),
    'Magento\\Wishlist\\Controller\\AbstractIndex_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Wishlist\\Controller\\AbstractIndex_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Wishlist\\Controller\\AbstractIndex_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'authentication',
      ),
    ),
    'Magento\\Checkout\\CustomerData\\Cart_getSectionData___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_core_cart_section',
      ),
    ),
    'Magento\\Checkout\\Controller\\Cart_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Checkout\\Controller\\Cart_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Checkout\\Controller\\Cart\\Index_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Checkout\\Controller\\Cart\\Index_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      4 => 
      array (
        0 => 'amazon_login_cart_controller',
      ),
    ),
    'Magento\\Checkout\\Controller\\Action_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Checkout\\Controller\\Action_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Checkout\\Controller\\Onepage_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Checkout\\Controller\\Onepage_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Checkout\\Controller\\Index\\Index_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Checkout\\Controller\\Index\\Index_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      4 => 
      array (
        0 => 'amazon_login_checkout_controller',
      ),
    ),
    'Magento\\Customer\\Controller\\AbstractAccount_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Customer\\Controller\\AbstractAccount_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Customer\\Controller\\Account\\Login_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Customer\\Controller\\Account\\Login_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      4 => 
      array (
        0 => 'amazon_login_login_controller',
      ),
    ),
    'Magento\\Customer\\Controller\\Account\\Create_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Customer\\Controller\\Account\\Create_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      4 => 
      array (
        0 => 'amazon_login_create_controller',
      ),
    ),
    'Magento\\Sales\\Api\\OrderCustomerManagementInterface_create___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_login_order_customer_service',
        1 => 'Ddg_CustomerManagementPlugin',
      ),
    ),
    'Magento\\Checkout\\Api\\ShippingInformationManagementInterface_saveAddressInformation___self' => 
    array (
      1 => 
      array (
        0 => 'amazon_payment_shipping_information_management',
      ),
    ),
    'Magento\\Quote\\Api\\Data\\PaymentInterface_getAdditionalInformation___self' => 
    array (
      4 => 
      array (
        0 => 'amazon_payment_additional_information',
      ),
    ),
    'Amazon\\Payment\\Model\\Method\\AmazonLoginMethod_isAvailable___self' => 
    array (
      4 => 
      array (
        0 => 'disable_amazon_payment_method',
      ),
    ),
    'Magento\\Quote\\Model\\PaymentMethodManagement_set___self' => 
    array (
      4 => 
      array (
        0 => 'confirm_order_reference_on_payment_details_save',
      ),
    ),
    'Magento\\Framework\\Webapi\\ErrorProcessor_maskException___self' => 
    array (
      1 => 
      array (
        0 => 'amazon_payment_webapi_error_processor',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Subscriber_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Newsletter\\Controller\\Subscriber_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Subscriber\\NewAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Newsletter\\Controller\\Subscriber\\NewAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      4 => 
      array (
        0 => 'ddg_newsletter_email_capture',
      ),
    ),
    'Magento\\Customer\\Model\\EmailNotificationInterface_newAccount___self' => 
    array (
      2 => 'ddg_customer_email_disabler',
    ),
    'Magento\\Reports\\Model\\ResourceModel\\Product\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Reports\\Model\\ResourceModel\\Product\\Collection_addViewsCount___self' => 
    array (
      2 => 'ddg_reports_product_collection',
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilder_setTemplateIdentifier___self' => 
    array (
      1 => 
      array (
        0 => 'magetrend-pdf-transport-builder',
        1 => 'Ddg_TransportBuilderPlugin',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilder_setTemplateVars___self' => 
    array (
      1 => 
      array (
        0 => 'magetrend-pdf-transport-builder',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilder_setTemplateOptions___self' => 
    array (
      1 => 
      array (
        0 => 'Ddg_TransportBuilderPlugin',
        1 => 'mageplaza_mail_template_transport_builder',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilder_setFrom___self' => 
    array (
      1 => 
      array (
        0 => 'mageplaza_mail_template_transport_builder',
      ),
    ),
    'Magento\\Framework\\Mail\\MessageInterface_setBody___self' => 
    array (
      1 => 
      array (
        0 => 'dotmailer_message_plugin',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Manage_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Newsletter\\Controller\\Manage_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
    ),
    'Magento\\Newsletter\\Controller\\Manage\\Index_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Newsletter\\Controller\\Manage\\Index_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'dotmailer_newsletter_plugin',
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite\\Save_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite\\Save_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
      4 => 
      array (
        0 => 'dotmailer_url_rewrite_save_plugin',
      ),
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite\\Save_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\UrlRewrite\\Controller\\Adminhtml\\Url\\Rewrite\\Save_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\SalesRule\\Api\\CouponRepositoryInterface_getById___self' => 
    array (
      4 => 
      array (
        0 => 'coupon_plugin',
      ),
    ),
    'Magento\\SalesRule\\Api\\CouponRepositoryInterface_save___self' => 
    array (
      4 => 
      array (
        0 => 'coupon_plugin',
      ),
    ),
    'Magento\\Framework\\Model\\ResourceModel\\Db\\Collection\\AbstractCollection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\SalesRule\\Model\\ResourceModel\\Coupon\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\SalesRule\\Model\\ResourceModel\\Coupon\\Collection_addRuleToFilter___self' => 
    array (
      4 => 
      array (
        0 => 'ddg_generated_for_email_plugin',
      ),
    ),
    'Magento\\SalesRule\\Model\\Utility_canProcessRule___self' => 
    array (
      4 => 
      array (
        0 => 'ddg_coupon_expired_plugin',
      ),
    ),
    'Magento\\CatalogInventory\\Api\\StockRegistryInterface_updateStockItemBySku___self' => 
    array (
      4 => 
      array (
        0 => 'ddg_stock_update_plugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Controller\\Ajax\\Emailcapture_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Dotdigitalgroup\\Email\\Controller\\Ajax\\Emailcapture_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      4 => 
      array (
        0 => 'ddg_chat_emailcapture_plugin',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\Save_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\Save_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
      4 => 
      array (
        0 => 'ddg_new_shipment_plugin',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\Save_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\Save_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\AddTrack_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\AddTrack_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
      4 => 
      array (
        0 => 'ddg_update_shipment_plugin',
      ),
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\AddTrack_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Shipping\\Controller\\Adminhtml\\Order\\Shipment\\AddTrack_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Dotdigitalgroup\\Email\\Model\\Cron\\Cleaner_getTablesForCleanUp___self' => 
    array (
      1 => 
      array (
        0 => 'ddg_sms_cron_cleaner_plugin',
      ),
    ),
    'Dotdigitalgroup\\Email\\Console\\Command\\Provider\\TaskProvider_getAvailableTasks___self' => 
    array (
      1 => 
      array (
        0 => 'ddg_sms_task_provider_plugin',
      ),
    ),
    'Magento\\Checkout\\Block\\Checkout\\LayoutProcessor_process___self' => 
    array (
      4 => 
      array (
        0 => 'ddg_sms_international_telephone_layout_processor_plugin',
      ),
    ),
    'Klarna\\Core\\Helper\\KlarnaConfig_getOmBuilderType___self' => 
    array (
      4 => 
      array (
        0 => 'klarnaKpKlarnaConfig',
      ),
    ),
    'Klarna\\Core\\Model\\Checkout\\Orderline\\Collector_isKlarnaActive___self' => 
    array (
      4 => 
      array (
        0 => 'klarnaKpCollector',
      ),
    ),
    'Magento\\Payment\\Helper\\Data_getPaymentMethods___self' => 
    array (
      4 => 
      array (
        0 => 'klarnaKpPaymentData',
      ),
    ),
    'Magento\\Payment\\Helper\\Data_getMethodInstance___self' => 
    array (
      2 => 'klarnaKpPaymentData',
    ),
    'Klarna\\Core\\Model\\Config_klarnaEnabled___self' => 
    array (
      4 => 
      array (
        0 => 'klarnaKpConfig',
      ),
    ),
    'Magento\\QuoteGraphQl\\Model\\Cart\\Payment\\AdditionalDataProviderPool_getData___self' => 
    array (
      1 => 
      array (
        0 => 'klarnaKpGraphQlAdditionalDataProviderPool',
      ),
    ),
    'Magento\\QuoteGraphQl\\Model\\Resolver\\AvailablePaymentMethods_resolve___self' => 
    array (
      4 => 
      array (
        0 => 'klarnaKpGraphQlAvailablePaymentMethods',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Items\\Renderer\\DefaultRenderer_getColumns___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_order_editor_update_default_item_renderer',
      ),
    ),
    'Magento\\Bundle\\Block\\Adminhtml\\Sales\\Order\\View\\Items\\Renderer_getColumns___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_order_editor_update_default_item_renderer',
      ),
    ),
    'Magento\\Bundle\\Block\\Adminhtml\\Sales\\Order\\View\\Items\\Renderer_toHtml___self' => 
    array (
      1 => 
      array (
        0 => 'mageworx_order_editor_update_bundle_item_renderer',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Shipment\\Track_save___self' => 
    array (
      2 => 'mageworx_ordersgrid_sync_order_shipment_track',
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Address_save___self' => 
    array (
      2 => 'mageworx_ordersgrid_sync_order_address',
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Item_save___self' => 
    array (
      2 => 'mageworx_ordersgrid_sync_order_item',
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Tax_save___self' => 
    array (
      2 => 'mageworx_ordersgrid_sync_order_tax',
    ),
    'Magento\\CatalogUrlRewrite\\Observer\\ProductProcessUrlRewriteRemovingObserver_execute___self' => 
    array (
      1 => 
      array (
        0 => 'mw_product_delete_plugin',
      ),
    ),
    'Magento\\Sitemap\\Model\\Observer_scheduledGenerateSitemaps___self' => 
    array (
      2 => 'aroundScheduledGenerateSitemaps',
    ),
    'Magento\\Framework\\Data\\Form\\Element\\Factory_create___self' => 
    array (
      1 => 
      array (
        0 => 'md_base_form_additional_elements',
      ),
    ),
    'Magento\\Checkout\\Model\\ShippingInformationManagement_saveAddressInformation___self' => 
    array (
      1 => 
      array (
        0 => 'mpdt_saveDeliveryInformation',
        1 => 'amazon_payment_shipping_information_management',
      ),
    ),
    'Magento\\Framework\\App\\PageCache\\Kernel_load___self' => 
    array (
      1 => 
      array (
        0 => 'mplayerProcessRequest',
      ),
    ),
    'Magento\\Customer\\Model\\Address_updateData___self' => 
    array (
      1 => 
      array (
        0 => 'setShouldIgnoreValidation',
      ),
      4 => 
      array (
        0 => 'setShouldIgnoreValidation',
      ),
    ),
    'Magento\\Checkout\\Model\\TotalsInformationManagement_calculate___self' => 
    array (
      2 => 'saveShipingMethodOnCalculate',
    ),
    'Magento\\Quote\\Model\\Quote_getItemById___self' => 
    array (
      2 => 'getItemById_Osc',
    ),
    'Magento\\Checkout\\Helper\\Data_isAllowedGuestCheckout___self' => 
    array (
      4 => 
      array (
        0 => 'osc_allow_guest_checkout',
      ),
    ),
    'Magento\\Eav\\Model\\Attribute\\Data\\AbstractData_validateValue___self' => 
    array (
      1 => 
      array (
        0 => 'mposc_bypass_validate',
      ),
    ),
    'Magento\\Customer\\Model\\Attribute\\Data\\Postcode_validateValue___self' => 
    array (
      1 => 
      array (
        0 => 'mposc_bypass_validate',
      ),
      4 => 
      array (
        0 => 'mposc_bypass_validate_postcode',
      ),
    ),
    'Magento\\Quote\\Model\\QuoteValidator_validateBeforeSubmit___self' => 
    array (
      1 => 
      array (
        0 => 'mposc_set_should_ignore_validation_quote',
      ),
    ),
    'Magento\\Bundle\\Block\\Catalog\\Product\\View\\Type\\Bundle\\Option_getData___self' => 
    array (
      1 => 
      array (
        0 => 'mposc_append_item_option',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Options\\AbstractOptions_getOption___self' => 
    array (
      1 => 
      array (
        0 => 'mposc_append_item_layout',
      ),
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\ToOrderAddress_convert___self' => 
    array (
      2 => 'mposc_convert_quote_address_to_order_address',
    ),
    'Magento\\Quote\\Model\\Quote\\Address\\CustomAttributeList_getAttributes___self' => 
    array (
      4 => 
      array (
        0 => 'mposc_add_custom_field_to_address',
      ),
    ),
    'Magento\\Customer\\Model\\Address\\CustomAttributeList_getAttributes___self' => 
    array (
      4 => 
      array (
        0 => 'mposc_add_custom_field_to_customer',
      ),
    ),
    'Magento\\Framework\\Mail\\Template\\TransportBuilderByStore_setFromByStore___self' => 
    array (
      1 => 
      array (
        0 => 'mpsmtp_appTransportBuilder',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Invoice_getPdf___self' => 
    array (
      2 => 'magetrend-invoice-pdf',
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Creditmemo_getPdf___self' => 
    array (
      2 => 'magetrend-creditmemo-pdf',
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Shipment_getPdf___self' => 
    array (
      2 => 'magetrend-shipment-pdf',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-guest-order-pdf-replace-print',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintInvoice_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintInvoice_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-guest-invoice-pdf-replace-print',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintCreditmemo_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintCreditmemo_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-guest-creditmemo-pdf-replace-print',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintShipment_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Guest\\PrintShipment_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
      ),
      2 => 'magetrend-guest-shipment-pdf-replace-print',
    ),
    'Magento\\Framework\\Mail\\TransportInterfaceFactory_create___self' => 
    array (
      1 => 
      array (
        0 => 'magetrend-pdf-transport-interface',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Pdf\\Total\\DefaultTotal_getTitleDescription___self' => 
    array (
      2 => 'magetrend-pdf-default-total',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order\\AbstractMassAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order\\AbstractMassAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order\\AbstractMassAction_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order\\AbstractMassAction_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\Pdfinvoices_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\Pdfinvoices_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\Pdfinvoices_massAction___self' => 
    array (
      2 => 'magetrend-pdf-mass-pdf-invoice-list',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\Pdfinvoices_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\Pdfinvoices_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\PrintAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\PrintAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
      2 => 'magetrend-pdf-mass-pdf-invoice',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\PrintAction_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Invoice\\AbstractInvoice\\PrintAction_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\Pdfshipments_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\Pdfshipments_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\Pdfshipments_massAction___self' => 
    array (
      2 => 'magetrend-pdf-mass-pdf-shipment-list',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\Pdfshipments_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\Pdfshipments_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\PrintAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\PrintAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
      2 => 'magetrend-pdf-mass-pdf-shipment',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\PrintAction_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Shipment\\AbstractShipment\\PrintAction_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\Pdfcreditmemos_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\Pdfcreditmemos_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\Pdfcreditmemos_massAction___self' => 
    array (
      2 => 'magetrend-pdf-mass-pdf-creditmemo-list',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\Pdfcreditmemos_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\Pdfcreditmemos_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\PrintAction_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\PrintAction_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
      2 => 'magetrend-pdf-mass-pdf-creditmemo',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\PrintAction_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Creditmemo\\AbstractCreditmemo\\PrintAction_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Framework\\Mail\\Message_setBody___self' => 
    array (
      4 => 
      array (
        0 => 'magetrend-pdf-message',
      ),
      1 => 
      array (
        0 => 'dotmailer_message_plugin',
      ),
    ),
    'Magento\\Framework\\Mail\\MimeMessage_getParts___self' => 
    array (
      4 => 
      array (
        0 => 'magetrend-pdf-mime-message',
      ),
    ),
    'Magento\\MediaGalleryIntegration\\Plugin\\SaveImageInformation_afterSave___self' => 
    array (
      2 => 'magetrend-241-bugfix',
    ),
    'Magento\\Framework\\App\\Request\\CsrfValidator_validate___self' => 
    array (
      2 => 'csrf_validator_skip_psigate',
    ),
    'Magento\\Framework\\View\\Asset\\Minification_getExcludes___self' => 
    array (
      4 => 
      array (
        0 => 'braintreeExcludeFromMinification',
      ),
    ),
    'Magento\\Catalog\\Pricing\\Render\\FinalPriceBox_setTemplate___self' => 
    array (
      1 => 
      array (
        0 => 'Sw_Dailydeals_change_template',
      ),
    ),
    'Vertex\\Utility\\SoapClientFactory_create___self' => 
    array (
      4 => 
      array (
        0 => 'registerLastCreatedClient',
      ),
    ),
    'Vertex\\Utility\\SoapClientFactory_getDefaultOptions___self' => 
    array (
      4 => 
      array (
        0 => 'registerLastCreatedClient',
      ),
    ),
    'Vertex\\Utility\\ServiceActionPerformerFactory_create___self' => 
    array (
      2 => 'useObjectManager',
    ),
    'Magento\\Sales\\Api\\OrderAddressRepositoryInterface_delete___self' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexVatCountryCode',
      ),
    ),
    'Magento\\Sales\\Api\\OrderAddressRepositoryInterface_deleteById___self' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexVatCountryCode',
      ),
    ),
    'Magento\\Sales\\Api\\OrderAddressRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexVatCountryCode',
      ),
    ),
    'Magento\\Sales\\Api\\OrderAddressRepositoryInterface_getList___self' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexVatCountryCode',
      ),
    ),
    'Magento\\Sales\\Api\\OrderAddressRepositoryInterface_save___self' => 
    array (
      4 => 
      array (
        0 => 'extensionAttributeVertexVatCountryCode',
      ),
    ),
    'Magento\\Tax\\Api\\TaxCalculationInterface_calculateTax___self' => 
    array (
      2 => 'vertexTaxCalculation',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax_mapItem___self' => 
    array (
      4 => 
      array (
        0 => 'apply_tax_class_id',
      ),
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax_mapItems___self' => 
    array (
      4 => 
      array (
        0 => 'vertexItemLevelMap',
      ),
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax_getShippingDataObject___self' => 
    array (
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax_mapAddress___self' => 
    array (
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax_mapItemExtraTaxables___self' => 
    array (
      2 => 'vertexItemLevelMap',
    ),
    'Magento\\Tax\\Model\\Sales\\Total\\Quote\\Tax_mapQuoteExtraTaxables___self' => 
    array (
      2 => 'vertexOrderLevelMap',
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_custom_option_flex_field_db_handler',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface_getList___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_custom_option_flex_field_db_handler',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface_getProductOptions___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_custom_option_flex_field_db_handler',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface_save___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_custom_option_flex_field_db_handler',
      ),
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface_delete___self' => 
    array (
      2 => 'vertex_custom_option_flex_field_db_handler',
    ),
    'Magento\\Catalog\\Api\\ProductCustomOptionRepositoryInterface_duplicate___self' => 
    array (
      2 => 'vertex_custom_option_flex_field_db_handler',
    ),
    'Magento\\Sales\\Api\\CreditmemoRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'get_vertex_creditmemo_item_attributes',
      ),
    ),
    'Magento\\Sales\\Api\\CreditmemoRepositoryInterface_getList___self' => 
    array (
      4 => 
      array (
        0 => 'get_vertex_creditmemo_item_attributes',
      ),
    ),
    'Magento\\Sales\\Api\\InvoiceRepositoryInterface_get___self' => 
    array (
      4 => 
      array (
        0 => 'get_vertex_invoice_item_attributes',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\ListProduct_getImage___self' => 
    array (
      1 => 
      array (
        0 => 'add_product_object_to_image_data_array',
      ),
    ),
    'Magento\\Catalog\\Block\\Product\\ListProduct_getReviewsSummaryHtml___self' => 
    array (
      2 => 'yotpo_yotpo_catalog_block_product_listproduct_plugin',
    ),
    'Magento\\Review\\Block\\Product\\ReviewRenderer_getReviewsSummaryHtml___self' => 
    array (
      2 => 'yotpo_yotpo_review_block_product_reviewrenderer_plugin',
    ),
    'Magento\\Catalog\\Block\\Product\\View\\Details_toHtml___self' => 
    array (
      1 => 
      array (
        0 => 'yotpo_yotpo_catalog_block_product_view_details_plugin',
      ),
    ),
    'Magento\\Backend\\Model\\Auth\\Session_prolong___self' => 
    array (
      2 => 'security_admin_sessions_prolong',
    ),
    'Magento\\Eav\\Model\\Adminhtml\\System\\Config\\Source\\Inputtype_getVolatileInputTypes___self' => 
    array (
      4 => 
      array (
        0 => 'append_compatible_input_types',
      ),
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth\\Login_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth\\Login_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
        3 => 'security_login_form',
      ),
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth\\Login_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Backend\\Controller\\Adminhtml\\Auth\\Login_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\User\\Model\\UserValidationRules_addUserInfoRules___self' => 
    array (
      4 => 
      array (
        0 => 'user_expiration_validator',
      ),
    ),
    'Magento\\User\\Block\\User\\Edit\\Tab\\Main_getFormHtml___self' => 
    array (
      2 => 'user_expiration_user_form_field',
    ),
    'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Action\\Full_execute___self' => 
    array (
      4 => 
      array (
        0 => 'invalidate_pagecache_after_full_reindex',
      ),
    ),
    'Magento\\Eav\\Api\\AttributeSetRepositoryInterface_delete___self' => 
    array (
      4 => 
      array (
        0 => 'remove_products',
      ),
    ),
    'Magento\\Catalog\\Model\\ProductLink\\Search_prepareCollection___self' => 
    array (
      4 => 
      array (
        0 => 'processOutOfStockProducts',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Rule_getMatchingProductIds___self' => 
    array (
      4 => 
      array (
        0 => 'addVariationsToProductRule',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Rule_validate___self' => 
    array (
      4 => 
      array (
        0 => 'configurableChildValidation',
      ),
    ),
    'Magento\\Catalog\\Model\\Category_save___self' => 
    array (
      4 => 
      array (
        0 => 'apply_after_products_assign',
      ),
    ),
    'Magento\\Catalog\\Model\\Category_delete___self' => 
    array (
      4 => 
      array (
        0 => 'apply_after_products_assign',
      ),
    ),
    'Magento\\Customer\\Model\\Group_delete___self' => 
    array (
      4 => 
      array (
        0 => 'reindex_after_delete_customer_group',
      ),
    ),
    'Magento\\Catalog\\Block\\Adminhtml\\Product\\Edit\\Tab\\Attributes_setForm___self' => 
    array (
      4 => 
      array (
        0 => 'product_form_url_key_plugin',
      ),
    ),
    'Magento\\Bundle\\Block\\Adminhtml\\Catalog\\Product\\Edit\\Tab\\Attributes_setForm___self' => 
    array (
      4 => 
      array (
        0 => 'product_form_url_key_plugin',
        1 => 'bundle_msrp_plugin',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar_getItemQty___self' => 
    array (
      2 => 'GroupedProduct',
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar_isConfigurationRequired___self' => 
    array (
      2 => 'GroupedProduct',
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar_getItemQty_GroupedProduct' => 
    array (
      2 => 'Bundle',
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar_isConfigurationRequired_GroupedProduct' => 
    array (
      2 => 'Bundle',
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar_getItemQty_Bundle' => 
    array (
      2 => 'configurable',
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Sidebar\\AbstractSidebar_isConfigurationRequired_Bundle' => 
    array (
      2 => 'configurable',
    ),
    'Magento\\Bundle\\Model\\ResourceModel\\Selection\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Bundle\\Model\\ResourceModel\\Selection\\Collection_addStoreFilter___self' => 
    array (
      2 => 'Bundle',
    ),
    'Magento\\Framework\\View\\TemplateEngineFactory_create___self' => 
    array (
      4 => 
      array (
        0 => 'debug_hints',
      ),
    ),
    'Magento\\Catalog\\Block\\Adminhtml\\Product\\Attribute\\Edit\\Tab\\Front_setForm___self' => 
    array (
      1 => 
      array (
        0 => 'search_weigh',
      ),
    ),
    'Magento\\Sales\\Model\\AdminOrder\\Product\\Quote\\Initializer_init___self' => 
    array (
      4 => 
      array (
        0 => 'sales_adminorder_quote_initializer_plugin',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Builder_build___self' => 
    array (
      4 => 
      array (
        0 => 'configurable',
      ),
    ),
    'Magento\\Catalog\\Model\\Product\\Validator_validate___self' => 
    array (
      1 => 
      array (
        0 => 'configurable',
      ),
      4 => 
      array (
        0 => 'configurable',
      ),
    ),
    'Magento\\Sales\\Model\\Order\\Invoice_setTotalQty___self' => 
    array (
      1 => 
      array (
        0 => 'update_configurable_product_total_qty',
      ),
    ),
    'Magento\\Backend\\Block\\Widget\\Button\\ToolbarInterface_pushButtons___self' => 
    array (
      1 => 
      array (
        0 => 'login_as_customer_button_toolbar',
      ),
    ),
    'Magento\\Customer\\Model\\Customer\\DataProviderWithDefaultAddresses_getData___self' => 
    array (
      4 => 
      array (
        0 => 'login_as_customer_customer_data_provider_plugin',
        1 => 'ShowVertexCustomerAttributes',
      ),
    ),
    'Magento\\Customer\\Model\\Customer\\DataProviderWithDefaultAddresses_getMeta___self' => 
    array (
      4 => 
      array (
        0 => 'login_as_customer_customer_data_provider_plugin',
        1 => 'ShowVertexCustomerAttributes',
      ),
    ),
    'Magento\\Customer\\Model\\Metadata\\Form_extractData___self' => 
    array (
      1 => 
      array (
        0 => 'login_as_customer_customer_data_validate_plugin',
      ),
    ),
    'Magento\\LoginAsCustomerAdminUi\\Ui\\Customer\\Component\\Button\\DataProvider_getData___self' => 
    array (
      4 => 
      array (
        0 => 'login_as_customer_button_data_provider_plugin',
      ),
    ),
    'Magento\\Catalog\\Model\\ImageUploader_moveFileFromTmp___self' => 
    array (
      4 => 
      array (
        0 => 'save_category_image',
      ),
    ),
    'Magento\\Ui\\Component\\Form\\Element\\DataType\\Media\\OpenDialogUrl_get___self' => 
    array (
      4 => 
      array (
        0 => 'new_media_gallery_open_dialog_url',
      ),
    ),
    'Magento\\Framework\\File\\Uploader_save___self' => 
    array (
      4 => 
      array (
        0 => 'save_asset_image',
      ),
    ),
    'Magento\\Cms\\Block\\Adminhtml\\Wysiwyg\\Images\\Content_setLayout___self' => 
    array (
      1 => 
      array (
        0 => 'add_search_button',
      ),
    ),
    'Magento\\MediaGalleryUi\\Model\\GetDetailsByAssetId_execute___self' => 
    array (
      4 => 
      array (
        0 => 'add_adobe_stock_image_details_plugin',
      ),
    ),
    'Magento\\MediaGalleryUi\\Ui\\Component\\Listing\\Columns\\Source\\Options_toOptionArray___self' => 
    array (
      4 => 
      array (
        0 => 'add_adobe_stock_source_option_plugin',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\AbstractIndexer_executeFull___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\AbstractIndexer_executeList___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\AbstractIndexer_executeRow___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\Product\\ProductRuleIndexer_executeFull___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\Product\\ProductRuleIndexer_executeList___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
      2 => 'productRuleReindex',
    ),
    'Magento\\CatalogRule\\Model\\Indexer\\Product\\ProductRuleIndexer_executeRow___self' => 
    array (
      4 => 
      array (
        0 => 'cache_cleaner_after_reindex',
      ),
      2 => 'productRuleReindex',
    ),
    'Magento\\Config\\Model\\Config\\Structure_getElementByPathParts___self' => 
    array (
      2 => 'paypal_system_configuration',
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Element\\Field_getConfigPath___self' => 
    array (
      4 => 
      array (
        0 => 'paypal_system_configuration_field',
      ),
    ),
    'Magento\\Backend\\Block\\Store\\Switcher_getUrl___self' => 
    array (
      1 => 
      array (
        0 => 'paypal_store_switcher',
      ),
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed\\Index_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed\\Index_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed\\Index_dispatch___self' => 
    array (
      2 => 'adminAuthentication',
    ),
    'Magento\\Rss\\Controller\\Adminhtml\\Feed\\Index_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
        1 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute\\Save_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute\\Save_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
      ),
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute\\Save_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'save_swatches_frontend_input',
        1 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Catalog\\Controller\\Adminhtml\\Product\\Attribute\\Save_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'Magento\\AdminNotification\\Model\\ResourceModel\\System\\Message\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\AdminNotification\\Model\\ResourceModel\\System\\Message\\Collection\\Synchronized_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\AdminNotification\\Model\\ResourceModel\\System\\Message\\Collection\\Synchronized_toArray___self' => 
    array (
      4 => 
      array (
        0 => 'afterToArray',
      ),
    ),
    'Magento\\AdminNotification\\Ui\\Component\\DataProvider\\DataProvider_getMeta___self' => 
    array (
      4 => 
      array (
        0 => 'afterGetMeta',
      ),
    ),
    'Magento\\Widget\\Model\\Widget_getPlaceholderImageUrl___self' => 
    array (
      2 => 'change_widget_placeholder',
    ),
    'Magento\\Cms\\Model\\Page\\DataProvider_prepareMeta___self' => 
    array (
      4 => 
      array (
        0 => 'google_optimizer_cms_page_data_provider',
      ),
    ),
    'Magento\\Cms\\Model\\Page\\DataProvider_getMeta___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_custom_canonical_cms_page_data_provider',
      ),
    ),
    'Magento\\Catalog\\Ui\\DataProvider\\Product\\Form\\NewCategoryDataProvider_getMeta___self' => 
    array (
      4 => 
      array (
        0 => 'google_optimizer_product_new_category_data_provider',
      ),
    ),
    'Magento\\Shipping\\Block\\Adminhtml\\Order\\Packaging_isDisplayGirthValue___self' => 
    array (
      2 => 'usps',
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Info_getCustomerAccountData___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_order_editor_add_device_info_to_customer_account_block',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Info_getAddressEditLink___self' => 
    array (
      4 => 
      array (
        0 => 'klarnaCoreValidationInfo',
      ),
    ),
    'Magento\\InventoryConfigurationApi\\Model\\IsSourceItemManagementAllowedForProductTypeInterface_execute___self' => 
    array (
      2 => 'mageworx_ordereditor_disable_msi',
    ),
    'Magento\\InventorySalesApi\\Api\\IsProductSalableInterface_execute___self' => 
    array (
      2 => 'mageworx_ordereditor_disable_inventory_detection',
    ),
    'Magento\\InventorySales\\Plugin\\StockState\\CheckQuoteItemQtyPlugin_aroundCheckQuoteItemQty___self' => 
    array (
      2 => 'mageworx_ordereditor_disable_qty_validation',
    ),
    'Magento\\CatalogInventory\\Observer\\QuantityValidatorObserver_execute___self' => 
    array (
      2 => 'mageworx_ordereditor_disable_qty_validation_for_backorders',
    ),
    'Magento\\GiftCardAccount\\Model\\Plugin\\TotalsCollector_beforeCollect___self' => 
    array (
      2 => 'mageworx_order_editor_void_giftcard_totals',
    ),
    'Magento\\CustomerBalance\\Model\\Total\\Quote\\Customerbalance_collect___self' => 
    array (
      2 => 'mageworx_order_editor_disable_storecredit_totals_collect',
    ),
    'Magento\\Payment\\Model\\Method\\Adapter_capture___self' => 
    array (
      1 => 
      array (
        0 => 'mageworx_ordereditor_authorizenet_capture_actual_amount_correct_amount',
      ),
    ),
    'Magento\\AuthorizenetAcceptjs\\Gateway\\Request\\CaptureDataBuilder_build___self' => 
    array (
      4 => 
      array (
        0 => 'mageworx_ordereditor_authorizenet_capture_actual_amount_add_amount',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order_execute___self' => 
    array (
      1 => 
      array (
        0 => 'eventDispatch',
      ),
      4 => 
      array (
        0 => 'eventDispatch',
      ),
      2 => 'actionFlagNoDispatch',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order_execute_actionFlagNoDispatch' => 
    array (
      1 => 
      array (
        0 => 'designLoader',
        1 => 'customerNotification',
        2 => 'themeRegistrationFromFilesystem',
        3 => 'synchronizeOrderGrid',
      ),
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order_dispatch___self' => 
    array (
      1 => 
      array (
        0 => 'adminMassactionKey',
      ),
      2 => 'adminAuthentication',
    ),
    'Magento\\Sales\\Controller\\Adminhtml\\Order_dispatch_adminAuthentication' => 
    array (
      1 => 
      array (
        0 => 'adminLoadDesign',
      ),
    ),
    'MageWorx\\SeoReports\\Model\\Config\\Product_getConfig___self' => 
    array (
      4 => 
      array (
        0 => 'addSeoNameToProductReportConfig',
      ),
    ),
    'MageWorx\\SeoReports\\Model\\Config\\Category_getConfig___self' => 
    array (
      4 => 
      array (
        0 => 'addSeoNameToCategoryReportConfig',
      ),
    ),
    'Magento\\Backend\\Model\\View\\Result\\Page_renderResult___self' => 
    array (
      1 => 
      array (
        0 => 'updateBodyClass',
      ),
    ),
    'Magento\\Backend\\Model\\View\\Result\\Page_setActiveMenu___self' => 
    array (
      1 => 
      array (
        0 => 'magedelight_base_modify_setactivemenu',
      ),
    ),
    'Magento\\Backend\\Model\\Menu\\Item_getUrl___self' => 
    array (
      4 => 
      array (
        0 => 'md_common_menu_item_newtab',
        1 => 'md_monerisca_menu_item_newtab',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Data_merge___self' => 
    array (
      1 => 
      array (
        0 => 'mageplaza_module_activate',
      ),
    ),
    'Magento\\Backend\\Model\\Menu\\Builder\\AbstractCommand_execute___self' => 
    array (
      4 => 
      array (
        0 => 'mageplaza_move_menu',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\View\\Tab\\Info_getGiftOptionsHtml___self' => 
    array (
      4 => 
      array (
        0 => 'mp_delivery_information',
        1 => 'osc_additional_content',
      ),
    ),
    'Magento\\Ui\\Component\\Listing\\Columns\\Column_prepare___self' => 
    array (
      4 => 
      array (
        0 => 'osc_customer_grid',
      ),
    ),
    'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\SearchResult_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Grid\\Collection_getCurPage___self' => 
    array (
      4 => 
      array (
        0 => 'currentPageDetection',
      ),
    ),
    'Magento\\Sales\\Model\\ResourceModel\\Order\\Grid\\Collection_load___self' => 
    array (
      1 => 
      array (
        0 => 'braintreeSalesOrderGrid',
      ),
    ),
    'Magento\\Config\\Model\\Config\\Structure\\Element\\Group_setData___self' => 
    array (
      2 => 'ConfigGroupPlugin',
    ),
    'Magento\\Customer\\Model\\Customer\\DataProvider_getData___self' => 
    array (
      4 => 
      array (
        0 => 'ShowVertexCustomerAttributes',
      ),
    ),
    'Magento\\Customer\\Model\\Customer\\DataProvider_getMeta___self' => 
    array (
      4 => 
      array (
        0 => 'ShowVertexCustomerAttributes',
      ),
    ),
    'Magento\\Sales\\Block\\Adminhtml\\Order\\Create\\Form\\Address_getForm___self' => 
    array (
      4 => 
      array (
        0 => 'vertex_addressvalidation_admin_order_form',
      ),
    ),
    'Magento\\Backend\\Block\\Dashboard\\Grids_toHtml___self' => 
    array (
      1 => 
      array (
        0 => 'yotpo_yotpo_backend_block_dashboard_grids_plugin',
      ),
    ),
  ),
);