using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace passport
{
    public static class CookieManager
    {
        private readonly static DateTime ExpirationDate = new DateTime(1990, 1, 1);

        private static HttpCookieCollection m_RequestCookies
        {
            get
            {
                return HttpContext.Current.Request.Cookies;
            }
        }

        private static HttpCookieCollection m_ResponseCookies
        {
            get
            {
                return HttpContext.Current.Response.Cookies;
            }
        }

        #region copy cookie
        /// <summary>
        /// 
        /// </summary>
        /// <param name="cookieName"></param>
        internal static void CopyCookieToResponse(string cookieName)
        {
            HttpCookie cookie = m_ResponseCookies[cookieName];
            cookie.Value = m_RequestCookies[cookieName].Value;
        }
        #endregion

        #region delete cookie
        internal static void DeleteCookie(string cookieName, string domainName)
        {
            HttpCookie cookie = m_ResponseCookies[cookieName];
            cookie.Expires = ExpirationDate;
            if (!string.IsNullOrEmpty(domainName))
            {
                cookie.Domain = domainName;
            }
        }
        internal static void DeleteSubCookieValue(string cookieName, string index)
        {
            HttpCookie cookie = m_ResponseCookies[cookieName];
            cookie.Values.Remove(index);
        }

        #endregion

        #region get cookie value
        internal static string GetCookieValue(string cookieName, bool fromResponse)
        {
            HttpCookie cookie;
            if (fromResponse)
            {
                cookie = m_ResponseCookies[cookieName];
            }
            else
            {
                cookie = m_RequestCookies[cookieName];
            }
            return GetCookieValue(cookie);
        }
        internal static string GetCookieValue(string cookieName, string index, bool fromResponse)
        {
            HttpCookie cookie;
            if (fromResponse)
            {
                cookie = m_ResponseCookies[cookieName];
            }
            else
            {
                cookie = m_RequestCookies[cookieName];
            }
            return GetCookieValue(cookie, index);
        }
        private static string GetCookieValue(HttpCookie cookie)
        {
            if (cookie == null)
            {
                return null;
            }
            return Decode(cookie.Value);
        }
        private static string GetCookieValue(HttpCookie cookie, string index)
        {
            if (cookie == null)
            {
                return null;
            }
            return Decode(cookie[index]);
        }
        #endregion

        #region set cookie value
        internal static void SetCookie(string cookieName, string val)
        {
            val = Encode(val);
            m_ResponseCookies[cookieName].Value = val;
        }

        internal static void SetCookie(string cookieName, string index, string val)
        {
            val = Encode(val);
            m_ResponseCookies[cookieName][index] = val;
        }
        #endregion

        #region encode & decode functions
        private static string Encode(string input)
        {
            if (string.IsNullOrEmpty(input))
            {
                return null;
            }
            return HttpUtility.UrlPathEncode(input).Replace("_", "%5F");
        }
        private static string Decode(string input)
        {
            return HttpUtility.UrlDecode(input);
        }
        #endregion

        #region Set Cookie Property
        internal static void SetDomain(string cookieName, string domainName)
        {
            if (string.IsNullOrEmpty(domainName))
            {
                return;
            }
            m_ResponseCookies[cookieName].Domain = domainName;
        }

        internal static void SetCookieExpires(string cookieName, TimeSpan expireDate)
        {
            if (expireDate == null || expireDate.Ticks == 0)
            {
                return;
            }
            m_ResponseCookies[cookieName].Expires = DateTime.Now.Add(expireDate);
        }

        internal static void SetCookiePath(string cookieName, string path)
        {
            if (string.IsNullOrEmpty(path))
            {
                return;
            }
            m_ResponseCookies[cookieName].Path = path;
        }

        internal static void SetCookieSecurity(string cookieName, bool secureOnly)
        {
            m_ResponseCookies[cookieName].Secure = secureOnly;
        }
        #endregion

    }
}