<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016091900549697",

		//商户私钥
		'merchant_private_key' => "MIIEogIBAAKCAQEAtii9kYVoUKZmMI/s4g6yTmUDjxTSnitm4PCUJCIqV23kBlkuqIGEItgPfQRkUJRq2D4qizlV8DFvb56A34vXYLJL45rdKbaUYI8EgIMFWOhUJbn9bJWeZlhILuHKMb+CaJ83hwptqtS31aGO9Ow7Aeinb/Z0o+OgZG1Bko804BKholZ842Xo2bBxNtAPzuOUjohFp7aT2eMqn1UBy8wMarHrYw+NYhD5dGrFWuSlN6BiLPfPqp2PnhKNSpE4isL3RO/6RE3AbHz0ju843J+vgbBl8vQKeYJ0+U427GD6ArDRNtLaC6zOjeicsWES0ssKSjKfl5UuPXbRTiDUuWjArQIDAQABAoIBAAPnA4imjwGLTw0jSDPflLpRN65NB+YTj/SpssLDaJzO4d+w8Wryu13zuwE2ot+HDnLrggXRiKHIrVZ60s/3MvoDV9TccHiATNV0uuf15pts/sCAJ4m3+ti+c21tsOM38xdCsfHWq1rJi9ary2A731e/IDcp1H3eVoVQQeNd5ggW1NGMjxQ2ghxOK9e7Xijwzch1NfNmF6MD7UdeW2Z4xOHSEFFeWXPTXNnKelSjL1gPbf78PDgSJ+TG46nSXMxcmyRu9hn+8Jwf49he4mgDaZTEKMhl4sUe6Q6IOw6E6f8kxadGtbE8aRbDFMDcpXjCn0RZh491jWtH6kwdTFvEuRECgYEA5w+P4RyvD6bYaqJRal0FmGUGADs4LvwQleGHr043JWzqiO4RchmZevGu2I+wxMiHkeFaZIQGCcGuK+CZVYMQkspuZnpXE84Rw4kNyVKnLdg95R9y7SJBLSS/mAosTiLmUModLmJLrVIyiG/KALlMaEXD7FaF2CCEHLn3atmSIDsCgYEAydH6RwgQ3Q/IrrYwQu1QuY/M9Fr7Sa3D8MRuu111qIZbx/B+r6w9BfVdFocY5PKaQxdsspIaFQHPg5BBEquLGSqfv2AEyTvdtEHrI+NZN/creW5eQf09PKCJ9HHkWXKdIw9JjQn/s/t/d3UeTaY9t1sURyF+xBeZcAPTQ8ECPDcCgYB9DSoUbl68fNMR2ylvBEs78CjwRRyiKR+czoONuCoWYj0IwLfGZd5v8I9te07zIYhlxm4SinVuIFlwO80gv59foplfcwTfnh51Eh7Y/5elMyxEbeHYPzrBAOuEkLTr0O2PeeOTL/W/JwZcWwwbmi2lHWTs6uLjVq3Jkkg6lugD8wKBgBLLSgpJVwCvEpoqfy4MWYMeQBDVVCdVVjTaphEur+FEudFRtQp4+KnQYp3RcOEJMpJi4Q10C5e/NmrjCRxK+0YZsQyqTWfL+mZp6RLLfih3DQZe38o3Yfd+X7pyzLgDs1xrdQb8UmKZXhJqxqqme4LSqX3CQcLTC8fho0/g7mtbAoGAN2g7JhMbBiuJUEVixTqDpreU8J7XcRvC7NaSxrq+fEY8kl56Opi+7GpIPUMfhs/k6Dq6tprOXAsNn3y7qUwXQTRlam5WGXs5Zy5QQLZODtugGaxC2Yl1QWd5Bcjer2uNboBYR6x1laWvKfUf4ZLiLRaywz8XfTlMhMZG2gkgCzU=",
		
		//异步通知地址
		'notify_url' => "http://39.96.168.211/notify_url.php",
		
		//同步跳转
		'return_url' => "http://39.96.168.211/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtii9kYVoUKZmMI/s4g6yTmUDjxTSnitm4PCUJCIqV23kBlkuqIGEItgPfQRkUJRq2D4qizlV8DFvb56A34vXYLJL45rdKbaUYI8EgIMFWOhUJbn9bJWeZlhILuHKMb+CaJ83hwptqtS31aGO9Ow7Aeinb/Z0o+OgZG1Bko804BKholZ842Xo2bBxNtAPzuOUjohFp7aT2eMqn1UBy8wMarHrYw+NYhD5dGrFWuSlN6BiLPfPqp2PnhKNSpE4isL3RO/6RE3AbHz0ju843J+vgbBl8vQKeYJ0+U427GD6ArDRNtLaC6zOjeicsWES0ssKSjKfl5UuPXbRTiDUuWjArQIDAQAB",
);