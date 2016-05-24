DOCUMENTATION FOR SHUDIDOO BACK END



Links: (Where '/' in the beginning means 'base_url/''
etc. localhost:8888 or 51.25.1.65)
========================
==LOGIN & REGISTRATION==
========================
/checkLogin
Method: post
--Global: Two inputs
1.  username
2.  password
Notes: Returns result_array

/addUser
Method: post
--Mobile: Four inputs,
--Web: Three inputs
1.  username
2.  password
3.  age
(4.)    Int(1)
Notes: Please pass the number '1' into the 4th parameter for mobile POST usage

/logout
Method: get
--Web Only: No inputs
Notes: sess_destroy


===========================
==User Tag & Activity Tag==
===========================
/addUserTag
Method: post
--Global: 3 Inputs
1.  user_id
2.  tag_id
3.  count
Notes: Adds a many to many relationship. Make sure user and tag exist

/addActivityTags
Method: post
--Global: 2 Inputs
1.  activity_id
2.  tag_id
Notes: Adds a many to many relationship. Make sure activity and tag exist
