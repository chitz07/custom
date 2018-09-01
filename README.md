The module satisfies the following conditions :

Site API Key
1. A new field called Site API key is added to the site information settings form with "No API key yet" as default value.
2. Once a value is provided and saved, the value is stored inside a settings variable siteapikey.
3. User is given the information that the api key is set with the provided value.
4. The text of the save configuration button changes to Update Configuraiton.

JSON of basic page
1. If you access the URL 
http://localhost/page_jSON/{api_key}/{node_id_of_basic_page}
The module will check if the api_ley provided in the url is same as that is set via settings form and also the node id provided is of a basic page. IF both the conditions are satisfied, the node is converted to JSON format and the data is displayed to the user.

If any of the above condition fails, "Access denied" will be displayed to the user.


NOTE : To view the JSON format, serialization module should be enabled.
