using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Xml.Serialization;


namespace passport
{
    public static class CookieFactory
    {
        #region cookie属性设置
        private static CookieInfo _cookieInfo;
        public static CookieInfo CooikeInfo
        {
            get
            {
                if (_cookieInfo == null)
                {
                    _cookieInfo = new CookieInfo();
                    _cookieInfo.DomainName = "localhost";
                    _cookieInfo.Path = "";
                    _cookieInfo.Secure = false;
                    _cookieInfo.ExpireDate = "1";
                }
                return _cookieInfo;
            }
            set
            {
                _cookieInfo = value;
            }
        }
        #endregion

        internal static void CreateCookie(string cookieName, string value)
        {
            CookieManager.SetCookie(cookieName, value);
            int day = 0;
            int.TryParse(CooikeInfo.ExpireDate, out day);
            CookieManager.SetCookieExpires(cookieName, new TimeSpan(day, 0, 0, 0));
            CookieManager.SetCookiePath(cookieName, CooikeInfo.Path);
            //CookieManager.SetDomain(cookieName, CooikeInfo.DomainName);
            CookieManager.SetCookieSecurity(cookieName, CooikeInfo.Secure);
            CooikeInfo.Value = value;
        }

        //服务器端存储sessionid及用户信息
        private static IDictionary<string, string> cookieList = new Dictionary<string, string>();

        public static void StoreSession(string sessionId, string userName, bool fromMemchaced = true, int exprieday = 1)
        {
            if (fromMemchaced)
            {
                Memached.SetValue(sessionId, userName, DateTime.Now.AddDays(exprieday));
            }
            else
            {
                if (cookieList.ContainsKey(sessionId))
                {
                    cookieList.Remove(sessionId);
                }
                cookieList.Add(sessionId, userName);
            }
        }

        public static bool CheckValueIsExist(string sessionid, string value, bool fromMemcached = true)
        {
            bool isExist = false;
            if (fromMemcached)
            {
                isExist = Memached.GetValue(sessionid) == value && !string.IsNullOrEmpty(value);
            }
            else
            {
                if (cookieList.Keys.Contains(sessionid))
                {
                    if (cookieList[sessionid] == value)
                    {
                        isExist = true;
                    }
                }
            }
            return isExist;
        }
    }

    [Serializable]
    public class CookieInfo
    {
        public string DomainName { get; set; }
        public string ExpireDate { get; set; }
        public string Path { get; set; }
        public bool Secure { get; set; } //true：只能在 HTTPS 连接中被浏览器传递到服务器端进行会话验证，如果是 HTTP 连接则不会传递该信息
        public string CookieName { get; set; }
        public string Value { get; set; }
    }

    [Serializable]
    public class CookieUser
    {
        public string UserName { get; set; }

        public string SessionID { get; set; }
    }

}