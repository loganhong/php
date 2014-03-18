using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace passport
{
    public static class CookieFactory
    {
        #region cookie属性设置
        private static string Domain = "localhost";
        private static TimeSpan ExpireDate = new TimeSpan(0, 3, 0);
        private static string Path = "";
        private static bool Secure = false; //true：只能在 HTTPS 连接中被浏览器传递到服务器端进行会话验证，如果是 HTTP 连接则不会传递该信息
        #endregion

        internal static void CreateCookie(string cookieName, string value)
        {
            CookieManager.SetCookie(cookieName, value);
            CookieManager.SetCookieExpires(cookieName, ExpireDate);
            CookieManager.SetCookiePath(cookieName, Path);
            //CookieManager.SetDomain(cookieName, Domain);
            CookieManager.SetCookieSecurity(cookieName, Secure);
        }


        //服务器端存储sessionid及用户信息
        private static IDictionary<string, string> cookieList = new Dictionary<string, string>();

        public static void StoreSession(string sessionid, string customerName)
        {
            if (cookieList.ContainsKey(sessionid))
            {
                cookieList.Remove(sessionid);
            }
            cookieList.Add(sessionid, customerName);
        }

        public static bool CheckValueIsExist(string sessionid, string value)
        {
            bool isExist = false;
            if (cookieList.Keys.Contains(sessionid))
            {
                if (cookieList[sessionid] == value)
                {
                    isExist = true;
                }
            }
            return isExist;
        }
    }

    public class CookieInfo
    {
        public string DomainName { get; set; }
        public string ExpireDate { get; set; }
        public string Path { get; set; }
        public string Secure { get; set; } //true：只能在 HTTPS 连接中被浏览器传递到服务器端进行会话验证，如果是 HTTP 连接则不会传递该信息
        public string CookieName { get; set; }
        public string Value { get; set; }
    }

    public class UserInfo
    {
        public string UserName { get; set; }
        public string Password { get; set; }
        public string Email { get; set; }
        public string SessionID { get; set; }
    }

}