//USE PUBLIC APIS TO CONNECT AND AUTH ANY FRAUD

const settings = {
	"async": true,
	"crossDomain": true,
	"url": "https://love-calculator.p.rapidapi.com/getPercentage?sname=Alice&fname=John",
	"method": "GET",
	"headers": {
		"X-RapidAPI-Key": "5d9e556be9msh3edd455c0b17965p1702f9jsn0c74c0a4e01b",
		"X-RapidAPI-Host": "love-calculator.p.rapidapi.com"
	}
};

$.ajax(settings).done(function (response) {
	console.log(response);
});