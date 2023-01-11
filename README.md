# Convert types data
Convert to different formats.

For instance:

+ XML -> JSON
+ JSON -> XML
+ HTML -> JSON
+ HTML -> XML

etc.

HTML to JSON
```php
$html = "<html><body>Hello <i>This is my car</i></body></html>"

$convert = new Convert();
print $convert->to($html,'json') 
 ```
or use to constant
```php
$convert = new Convert();
print $convert->to($html,Convert::TYPE_JSON)
 ``` 

JSON to XML
```php
$json = "[
	{
		color: "red",
		value: "#f00"
	},
	{
		color: "green",
		value: "#0f0"
	},
	{
		color: "blue",
		value: "#00f"
	},
	{
		color: "cyan",
		value: "#0ff"
	},
	{
		color: "magenta",
		value: "#f0f"
	},
	{
		color: "yellow",
		value: "#ff0"
	},
	{
		color: "black",
		value: "#000"
	}
]"

$convert = new Convert();
print $convert->to($html,'xml')
 ``` 
or use to constant
```php
$convert = new Convert();
print $convert->to($html,Convert::TYPE_XML)
 ``` 