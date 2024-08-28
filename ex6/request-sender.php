<?php

require_once 'socket.php';

$request = "POST /~makalm/icd0007/foorum/?cmd=delete&id=7530&username=dianaryb HTTP/1.1
Host: enos.itcollege.ee
Content-Type: application/x-www-form-urlencoded
Content-Length: 0
X-Secret: 123456
Cookie: PHPSESSID=4jtjd52bpq19je1idd0pbs9kdn

";

//c238b8f15a

$request = "GET /~makalm/icd0007/foorum/?message=deleted&username=dianaryb&key=c238b8f15a HTTP/1.1
Host: enos.itcollege.ee
Cookie: PHPSESSID=4jtjd52bpq19je1idd0pbs9kdn

";

print makeWebRequest("enos.itcollege.ee", 443, $request);





