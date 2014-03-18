<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="login.aspx.cs" Inherits="passport.login" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<body>
    <form id="form1" runat="server" action="login.aspx" method="post">
        <div>
            <span>用户名：</span>
            <input name="UserName" type="text" value="" maxlength="20" />
            <span>密码：</span>
            <input name="Password" type="password" value="" maxlength="16" />
            <input  type="submit" value="submit"/>
        </div>
    </form>
</body>
</html>
