# REST API App w/ MessageBird

This is a sample REST API application uses MessageBird API. It allows you to make POST requests to send sms messages to anyone in the world.

**Technologies used;**
- MessageBird API client SDK for PHP
- PHPUnit for testing
- Swagger UI for the documentation and sending requests
- Composer for the dependency management

## Installation
* Clone the repository to the directory that can be reached on your localhost.

`git clone https://github.com/ebrukye/rest-api-app.git`

* Install necessary packages to your workspace via Composer running command below.

`composer install`

* You can see **/apidocs** page to see the documentation and send requests.
http://localhost/rest-api-app/apidocs/

![Scheme](assets/screenshot.png)

# REST API App w/ MessageBird

This is a sample REST API application uses MessageBird API. It allows you to make POST requests to send sms messages to anyone in the world.

**Technologies used;**
- MessageBird API client SDK for PHP
- PHPUnit for testing
- Swagger UI for the documentation and sending requests
- Composer for the dependency management

## Installation
* Clone the repository to the directory that can be reached on your localhost.

`git clone https://github.com/ebrukye/rest-api-app.git`

* Install necessary packages to your workspace via Composer running command below.

`composer install`

* You can see **/apidocs** page to see the documentation and send requests.
http://localhost/rest-api-app/apidocs/

![](https://serving.photos.photobox.com/05451872a03931b5491f7a218704384d940d93f9e687422b89fb62c64e92083df1c81276.jpg)

## Send Requests
* You can send requests using **Try it out** button on /apidocs page or send POST requests to the URL below using environments like **Postman.**

**Base URL**
http://localhost/rest-api-app

**Reguest**

| Method | URL         |
| -------|------------ |
| POST   | /messages

**Headers**

| Key           | Value               |
| --------------|-------------------- |
| Content-Type  | application/json
| Authorization | apiKey

Authorization header with a valid apiKey must be sent for authenticated requests.You can find sample data below.

**apiKey:** `rKNOfXdItLhfbGhcDFgYTDNFKitMDFZa`

**Request Body**

```
	{
		"recipient" : "31612345678",
		"originator": "MessageBird",
		"message": "This is a test message."
	}
```


