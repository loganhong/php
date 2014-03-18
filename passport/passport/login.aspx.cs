using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace passport
{
    public partial class login : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            var userName = Request["UserName"];
            var password = Request["Password"];
            CookieFactory.CreateCookie("user", userName);
            CookieFactory.CreateCookie("sid", HttpContext.Current.Session.SessionID);
            CookieFactory.StoreSession(HttpContext.Current.Session.SessionID, userName);
        }
    }
}