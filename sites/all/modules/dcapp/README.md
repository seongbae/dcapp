# DCApp Module
This is a Drupal module for DCApp website.  The main thing it does at the moment is exposing site data through REST API.

<a href="http://www.dcapp.org" target="_blank">DCApp</a> is a community portal for the Korean and Korean American communities of Maryland, Virginia, and Washington DC.

## Request & Response Examples

### API Resources
* [GET /dcapp_taxonomy](#get-dcapp_taxonomy)
* [GET /dcapp_business](#get-dcapp_business)
* [GET /dcapp_comment](#get-dcapp_comment)
 
### GET /dcapp_taxonomy

A taxonomy is composed of a vocabulary and associated terms. 

dcapp_taxonomy accepts following parameter(s):
* vid - Vocabulary ID (optional)

XML Example: http://example.com/api/v1/dcapp_taxonomy?vid=12

JSON Example: http://example.com/api/v1/dcapp_taxonomy.json?vid=12

Response Body:
```
<result is_array="true">
   <item>
      <vid>12</vid>
      <vname>Business Category</vname>
      <tid>227</tid>
      <name>SAT Prep</name>
      <description>버지니아, 메릴랜드, 센터빌, 애난데일에 위치한 중고등학생들을 위해 SAT 공부를 가르치는 업소들입니다. 디씨앱에서 리뷰를 쓰고 읽고 좋은정보를 많이 공유하세요.</description>
      <weight>4</weight>
      <parent_tid>221</parent_tid>
      <image_uri />
      <image2x_uri />
      <image3x_uri />
   </item>
   <item>
      <vid>12</vid>
      <vname>Business Category</vname>
      <tid>187</tid>
      <name>맛집</name>
      <description/>
      <weight>58</weight>
      <parent_tid>0</parent_tid>
      <image_uri>public://cat_icon_taxi.png</image_uri>
      <image2x_uri>public://cat_icon_taxi2x.png</image2x_uri>
      <image3x_uri>public://cat_icon_taxi3x.png</image3x_uri>
   </item>
</result>
```

### GET /dcapp_business

This endpoint has two functions: index and retrieve.  Index function returns list of businesses.  When latitude (lat) and longitude (lon) are provided, it will return distance field with distance in miles from a business to the coordinates provided sorted by distance from lowest to highest.  Retrieve function returns a single business.
>>>>>>> 2ceab701254c4a7088a6abe58e4d686cbc014e20

#### index

dcapp_business accepts following parameters:
* tid - Term/Category ID (optional)
* limit - how many to return (optional)
* offset - starting point (optional)
* lat - source latitude (optional)
* lon - destination longitude (optional)

XML Example: http://example.com/api/v1/dcapp_business?tid=212&limit=20&offset=0&lat=38.885057&lon=-77.39772

JSON Example: http://example.com/api/v1/dcapp_business.json?tid=212&limit=20&offset=0&lat=38.885057&lon=-77.39772
>>>>>>> 2ceab701254c4a7088a6abe58e4d686cbc014e20

Response Body:
```
<result is_array="true">
   <item>
      <created>1390448507</created>
      <changed>1437406194</changed>
      <name>명가김밥 - 센터빌</name>
      <nid>2094</nid>
      <sticky>0</sticky>
      <author>seongbae</author>
      <tid>112</tid>
      <term_name>식당 - 한식</term_name>
      <latitude>38.837094900000</latitude>
      <longitude>-77.439834900000</longitude>
      <userratingcount>2</userratingcount>
      <bizratingcount>0</bizratingcount>
      <openpositions>0</openpositions>
      <distance>7.89334</distance>
   </item>
   <item>
      <created>1390448553</created>
      <changed>1436902775</changed>
      <name>명가김밥 - 페어펙스</name>
      <nid>2095</nid>
      <sticky>0</sticky>
      <author>dcapp</author>
      <tid>112</tid>
      <term_name>식당 - 한식</term_name>
      <latitude>38.864222200000</latitude>
      <longitude>-77.278036300000</longitude>
      <userratingcount>1</userratingcount>
      <bizratingcount>0</bizratingcount>
      <openpositions>0</openpositions>
      <distance>10.1234</distance> 
   </item>
</result>
```

#### retrieve

dcapp_business/retrieve accepts following parameter(s):
* nid - Node ID (required)

XML Example: http://example.com/api/v1/dcapp_business/retrieve?nid=2012

JSON Example: http://example.com/api/v1/dcapp_business/retrieve.json?nid=2012

Response Body:
```
<result is_array="true">
   <item>
      <created>1389062045</created>
      <changed>1436840760</changed>
      <name>토속집</name>
      <name_en>To Sok Jip</name_en>
      <nid>2012</nid>
      <sticky>0</sticky>
      <author>dcapp</author>
      <tid>112</tid>
      <term_name>식당 - 한식</term_name>
      <phone>703-333-2861</phone>
      <email />
      <website>http://www.tosokjip.com</website>
      <street>7211 Columbia Pike</street>
      <street2 />
      <city>Annandale</city>
      <state>VA</state>
      <zip>22003</zip>
      <latitude>38.831390000000</latitude>
      <longitude>-77.193344200000</longitude>
      <summary>
         <p>버지니아 애난데일에 위치한 숨은 맛집 토속집 입니다.  생선구이, 생선조림, 토속비빔밥, 바지락 칼국수등 맛있는 한식음식을 저렴한 가격에 드셔보세요.</p>
      </summary>
      <body>
         <p>버지니아 애난데일에 위치한 숨은 맛집 토속집 입니다. 생선구이, 생선조림, 토속비빔밥, 바지락 칼국수등 맛있는 한식음식을 저렴한 가격에 드셔보세요.</p>
      </body>
      <userratingcount>8</userratingcount>
      <bizratingcount>0</bizratingcount>
   </item>
</result>
```

### GET /dcapp_comment

Returns comments associated with a node in Drupal.  

dcapp_comment accepts following parameter(s)
* nid - Node ID (required)

XML Example: http://example.com/api/v1/dcapp_comment?nid=2012

JSON Example: http://example.com/api/v1/dcapp_comment.json?vid=2012

Response Body:
```
<result is_array="true">
   <item>
      <cid>487</cid>
      <pid>0</pid>
      <uid>4712</uid>
      <name>Claypark</name>
      <subject>청국장과 생선구이 등등</subject>
      <body>청국장과 생선구이 등등 
 냄새 때문에 집에서 해먹기 귀찮은 음식들을 
 양도 넉넉하고 맛있게 만드시더군요.
 
 소문난 집이라서 오래 기다려야하니
 사람들이 많이 몰리는 
 식사시간 이외의 시간에 강추합니다.</body>
      <body_format>filtered_html</body_format>
      <created>1406619206</created>
      <changed>1406619206</changed>
   </item>
   <item>
      <cid>447</cid>
      <pid>0</pid>
      <uid>4632</uid>
      <name>nadu83</name>
      <subject>식당이 좀 작아서 바쁜시간엔 항상 기다려야 하지만..</subject>
      <body>식당이 좀 작아서 바쁜시간엔 항상 기다려야 하지만.....생선구이랑 청국장 정말 맛잇어요</body>
      <body_format>filtered_html</body_format>
      <created>1402752586</created>
      <changed>1402752586</changed>
   </item>
</result>
```

