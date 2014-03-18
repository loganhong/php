using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Web;
using System.Xml;
using System.Xml.Serialization;

namespace passport
{
    public static class ObjectSerialize
    {
        public static string SerializeToString<T>(T t) where T : class
        {
            StringBuilder sb = new StringBuilder();

            using (XmlWriter sWriter = XmlWriter.Create(sb))
            {
                XmlSerializer serializer = new XmlSerializer(typeof(T));
                serializer.Serialize(sWriter, t);
            }
            return sb.ToString();
        }
    }
}