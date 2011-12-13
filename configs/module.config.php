<?php
return array(
    'di' => array(
        'definition' => array(
            'class' => array(
                'Memcache' => array(
                    'addServer' => array(
                        'host'             => array('type' => false, 'required' => true),
                        'port'             => array('type' => false, 'required' => true),
                        'persistent'       => array('type' => false, 'required' => false),
                        'weight'           => array('type' => false, 'required' => false),
                        'timeout'          => array('type' => false, 'required' => false),
                        'retry_interval'   => array('type' => false, 'required' => false),
                        'status'           => array('type' => false, 'required' => false),
                        'failure_callback' => array('type' => false, 'required' => false),
                        'timeoutms'        => array('type' => false, 'required' => false),
                    )
                ),
                'SpiffyDoctrine\Factory\EntityManager' => array(
                    'instantiator' => array('SpiffyDoctrine\Factory\EntityManager', 'get'),
                    'methods' => array(
                        'get' => array(
                            'conn' => array('type' => 'SpiffyDoctrine\Instance\Connection', 'required' => true)
                        )
                    )
                ),
            ),
        ),
        'instance' => array(
            'alias' => array(
                'doctrine_memcache'       => 'Memcache',
                
                'doctrine_em'             => 'SpiffyDoctrine\Factory\EntityManager',
                'doctrine_config'         => 'SpiffyDoctrine\Instance\Configuration',
                'doctrine_connection'     => 'SpiffyDoctrine\Instance\Connection',
                'doctrine_evm'            => 'SpiffyDoctrine\Instance\EventManager',
                'doctrine_driver_chain'   => 'SpiffyDoctrine\Instance\DriverChain',
                'doctrine_cache_apc'      => 'Doctrine\Common\Cache\ApcCache',
                'doctrine_cache_array'    => 'Doctrine\Common\Cache\ArrayCache',
                'doctrine_cache_memcache' => 'Doctrine\Common\Cache\MemcacheCache', 
            ),
            'doctrine_memcache' => array(
                'parameters' => array(
                    'host' => '127.0.0.1',
                    'port' => '11211'
                )
            ),
            'doctrine_em' => array(
                'parameters' => array(
                    'conn' => 'doctrine_connection',
                )
            ),
            'doctrine_cache_memcache' => array(
                'parameters' => array(
                    'memcache' => 'doctrine_memcache' 
                )
            ),
            'doctrine_config' => array(
                'parameters' => array(
                    'opts' => array(
                        'auto_generate_proxies'     => true,
                        'proxy_dir'                 => __DIR__ . '/../../../data/SpiffyDoctrine/Proxy',
                        'proxy_namespace'           => 'SpiffyDoctrine\Proxy',
                        'custom_datetime_functions' => array(),
                        'custom_numeric_functions'  => array(),
                        'custom_string_functions'   => array(),
                        'custom_hydration_modes'    => array(),
                        'named_queries'             => array(),
                        'named_native_queries'      => array(),
                    ),
                    'metadataDriver' => 'doctrine_driver_chain',
                    'metadataCache'  => 'doctrine_cache_array',
                    'queryCache'     => 'doctrine_cache_array',
                    'resultCache'    => null,
                    'logger'         => null,
                )
            ),
            'doctrine_connection' => array(
                'parameters' => array(
                    'params' => array(
                        'driver'   => 'pdo_mysql',
                        'host'     => 'localhost',
                        'port'     => '3306', 
                        'user'     => 'testuser',
                        'password' => 'testpassword',
                        'dbname'   => 'testdbname',
                    ),
                    'config' => 'doctrine_config',
                    'evm'    => 'doctrine_evm'
                )
            ),
            'doctrine_driver_chain' => array(
                'parameters' => array(
                    'drivers' => array(),
                    'cache' => 'doctrine_cache_array'
                )
            ),
            'doctrine_evm' => array(
                'parameters' => array(
                    'opts' => array(
                        'subscribers' => array()
                    )
                )
            )
        )
    )
);