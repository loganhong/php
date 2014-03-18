using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace passport
{
    public partial class CheckLogin : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            var us = HttpContext.Current.Request.Cookies["user"] != null ? HttpContext.Current.Request.Cookies["user"].Value : "";
            var sid = HttpContext.Current.Request.Cookies["sid"] != null ? HttpContext.Current.Request.Cookies["sid"].Value : "";

            if (CookieFactory.CheckValueIsExist(sid, us) && us != null && sid != null)
            {
                Response.Write("us:" + us + "<br/> sid: " + sid + "has exist.");
            }
            else
            {
                Response.Write("us:" + us + "<br/> sid: " + sid + "do not exist.");
            }
        }
    }
}