using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Memcached.ClientLibrary;

namespace passport
{
    public static class Memached
    {
<<<<<<< HEAD
        private static MemcachedClient GetClient()
        {
            if (_pool == null)
            {
                Init();
            }
            else if (!_pool.Initialized)
            {
                Init();
            }

            MemcachedClient _mc = new MemcachedClient();
            _mc.PoolName = "default";
            return _mc;
        }

        private static SockIOPool _pool = null;

        private static void Init()
        {

            String[] serverlist = { "127.0.0.1:11211" };

            _pool = SockIOPool.GetInstance("default");

            _pool.SetServers(serverlist); //设置服务器列表

            //各服务器之间负载均衡的设置
            _pool.SetWeights(new int[] { 1 });

            //socket pool设置
            _pool.InitConnections = 5; //初始化时创建的连接数

            _pool.MinConnections = 5; //最小连接数

            _pool.MaxConnections = 250; //最大连接数

            //连接的最大空闲时间，下面设置为6个小时（单位ms），超过这个设置时间，连接会被释放掉
            _pool.MaxIdle = 1000 * 60 * 60 * 6;

            //通讯的超时时间，下面设置为3秒（单位ms），.NET版本没有实现
            _pool.SocketTimeout = 1000 * 3;

            //socket连接的超时时间，下面设置表示连接不超时，即一直保持连接状态
            _pool.SocketConnectTimeout = 0;

            _pool.Nagle = false; //是否对TCP/IP通讯使用Nalgle算法，.NET版本没有实现

            //维护线程的间隔激活时间，下面设置为60秒（单位s），设置为0表示不启用维护线程
            _pool.MaintenanceSleep = 60;

            //socket单次任务的最大时间，超过这个时间socket会被强行中断掉（当前任务失败）
            _pool.MaxBusy = 1000 * 10;

=======
        private static SockIOPool _pool;

        private static MemcachedClient mc;
        private static void SockIOPoolInit()
        {
            String[] serverlist = { "127.0.0.1:11211" };
            _pool = SockIOPool.GetInstance("default");
            _pool.SetServers(serverlist); //设置服务器列表
            //各服务器之间负载均衡的设置
            _pool.SetWeights(new int[] { 1 });
            //socket pool设置
            _pool.InitConnections = 5; //初始化时创建的连接数
            _pool.MinConnections = 5; //最小连接数
            _pool.MaxConnections = 250; //最大连接数
            //连接的最大空闲时间，下面设置为6个小时（单位ms），超过这个设置时间，连接会被释放掉
            _pool.MaxIdle = 1000 * 60 * 60 * 6;
            //通讯的超时时间，下面设置为3秒（单位ms），.NET版本没有实现
            _pool.SocketTimeout = 1000 * 3;
            //socket连接的超时时间，下面设置表示连接不超时，即一直保持连接状态
            _pool.SocketConnectTimeout = 0;
            _pool.Nagle = false; //是否对TCP/IP通讯使用Nalgle算法，.NET版本没有实现
            //维护线程的间隔激活时间，下面设置为60秒（单位s），设置为0表示不启用维护线程
            _pool.MaintenanceSleep = 60;
            //socket单次任务的最大时间，超过这个时间socket会被强行中断掉（当前任务失败）
            _pool.MaxBusy = 1000 * 10;
>>>>>>> origin/master
            _pool.Initialize();
        }

        private static void Shutdown()
        {
<<<<<<< HEAD

            _pool.Shutdown();
            _pool = null;
        }

        public static bool SetValue(string key, string value, DateTime expiry)
        {
            MemcachedClient mc = GetClient();
            if (mc.KeyExists(key))
            {
                mc.Delete(key);
            }
            return mc.Add(key, value, expiry);
        }

        public static string GetValue(string key)
        {
            MemcachedClient mc = GetClient();
            var value = mc.Get(key);
=======
            if (_pool != null)
            {
                _pool.Shutdown();
            }
        }

        private static MemcachedClient GetClient()
        {
            if (_pool == null)
            {
                SockIOPoolInit();
            }
            else if (!_pool.Initialized)
            {
                SockIOPoolInit();
            }
            if (mc != null)
            {
                mc = new MemcachedClient();
            }
            return mc;
        }

        internal static void SetValue(string sessionId, string userName, DateTime dateTime)
        {
            MemcachedClient _mc = GetClient();
            if (_mc.KeyExists(sessionId))
            {
                _mc.Delete(sessionId);
            }
            _mc.Add(sessionId, userName, dateTime);
        }

        internal static string GetValue(string sessionid)
        {

            MemcachedClient _mc = GetClient();

            var value = _mc.Get(sessionid);

>>>>>>> origin/master
            return value != null ? value.ToString() : string.Empty;
        }
    }
}