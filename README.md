[HTML5__BADGE]: https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white
[CSS3__BADGE]: https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white
[JAVASCRIPT__BADGE]: https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E
[BOOTSTRAP__BADGE]: https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white
[PHP__BADGE]: https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white
[MYSQL__BADGE]: https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white
[APACHE__BADGE]: https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white
[UDEMY__BADGE]: https://img.shields.io/badge/Udemy-A435F0?style=for-the-badge&logo=Udemy&logoColor=white

<h1 align="center" style="font-weight: bold;"> In'N Out 💻</h1>

![HTML5][HTML5__BADGE]
![CSS3][CSS3__BADGE]
![javascript][JAVASCRIPT__BADGE]
![Bootstrap][BOOTSTRAP__BADGE]
![PHP][PHP__BADGE]
![MySQL][MYSQL__BADGE]
![Apache][APACHE__BADGE]
![Udemy][UDEMY__BADGE]

<p align="center">
  <a href="#started">Getting Started</a> • 
  <a href="#routes">API Endpoints</a> •
</p>

<p align="center">
  <b>Simple description of what your project do or how to use it.</b>
</p>

<h2 id="started">🚀 Getting started</h2>

Here you describe how to run your project locally

<h3>Prerequisites</h3>

Here you list all prerequisites necessary for running your project. For example:

- [NodeJS](https://github.com/)
- [Git 2](https://github.com)

<h3>Cloning</h3>

How to clone your project

```bash
git clone your-project-url-in-github
```

<h3> Environment Variables</h2>

Use the `application.properties.example` as reference to create your configuration file `application.properties` with your AWS Credentials

```yaml
aws.region=us-east-1
aws.accessKeyId={YOUR_AWS_KEY_ID}
aws.secretKey={YOUR_AWS_SECRET}
```

<h3>Starting</h3>

How to start your project

```bash
cd project-name
npm some-command-to-run
``````


<h2 id="routes">📍 API Endpoints</h2>

Here you can list the main routes of your API, and what are their expected request bodies.
​
| route               | description                                          
|----------------------|-----------------------------------------------------
| <kbd>GET /authenticate</kbd>     | retrieves user info see [response details](#get-auth-detail)
| <kbd>POST /authenticate</kbd>     | authenticate user into the api see [request details](#post-auth-detail)

<h3 id="get-auth-detail">GET /authenticate</h3>

**RESPONSE**
```json
{
  "name": "Fernanda Kipper",
  "age": 20,
  "email": "her-email@gmail.com"
}
```

<h3 id="post-auth-detail">POST /authenticate</h3>

**REQUEST**
```json
{
  "username": "fernandakipper",
  "password": "4444444"
}
```

**RESPONSE**
```json
{
  "token": "OwoMRHsaQwyAgVoc3OXmL1JhMVUYXGGBbCTK0GBgiYitwQwjf0gVoBmkbuyy0pSi"
}
```
