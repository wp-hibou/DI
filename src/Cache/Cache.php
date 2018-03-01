<?php
/**
 * Created by PhpStorm.
 * User: alpipego
 * Date: 01.03.2018
 * Time: 09:52
 */
declare(strict_types=1);

namespace WPHibou\DI\Cache;

final class Cache implements CacheInterface
{
    private $cache;

    public function __construct(string $group = 'wp-hibou_di', string $key = 'container')
    {
        $this->cache =
            wp_using_ext_object_cache()
                ? new PersistentCache($group, $key)
                : new TransientCache($group, $key);
    }

    public function set(Container $container): bool
    {
        return $this->cache->set($container);
    }

    /**
     * @throws ContainerCacheException
     * @return Container
     */
    public function get(): Container
    {
        return $this->cache->get();
    }

    public function delete(): bool
    {
        return $this->cache->delete();
    }

    public function has(): bool
    {
        return $this->cache->has();
    }
}