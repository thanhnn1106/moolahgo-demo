<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Nguyen Ngoc Thanh">
    <title>MoolahGo | Lumen | Vue js</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.css" media="screen">
    <link rel="stylesheet" href="{{ url('/css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Moolah Go Application</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="app" class="container">
    <div v-if="visible == true" class="loading">Loading&#8230;</div>
    <div class="container">
        <br>
        <div class="alert alert-dismissible alert-danger" v-if="message != ''">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">@{{ message }}</h4>
            <p class="mb-0"></p>
        </div>
        <div>
            <div>
                <form action="#" @submit.prevent="findContact()">
                    <div class="form-group">
                        <h2>Input Referral Code</h2>
                        <input v-model="referralCode" type="text" name="referralCode" class="form-control">
                    </div>
                    <div class="form-group">
                        <button v-bind:disabled="isValidCode == false" type="submit" class="btn btn-primary">Find Owner</button>
                    </div>
                </form>
            </div>
            <hr>
            <table class="table">
                <thead class="table-success">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Referral Code</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>@{{contact.name}}</td>
                    <td>@{{contact.email}}</td>
                    <td>@{{contact.referralCode}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer id="footer" class="container">
        <p class="center">Valid code: THANH1</p>
    </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: function(){
                return {
                    referralCode: '',
                    isValidCode: false,
                    visible: false,
                    message:'',
                    contact:{
                        name:'',
                        email:'',
                        referralCode:''
                    },
                }
            },
            methods: {
                findContact: function(id) {
                    console.log('Find contact...');
                    let self = this;
                    self.contact.name = '';
                    self.contact.email = '';
                    self.contact.referralCode = '';
                    self.message = '';
                    self.visible = true;
                    let params = {referral_code: self.referralCode};
                    axios.post('api/process/', params)
                        .then(function(response){
                            self.visible = false;
                            self.contact.name = response.data.name;
                            self.contact.email = response.data.email;
                            self.contact.referralCode = response.data.referral_code;
                        })
                        .catch(error => {
                            self.visible = false;
                            if(error.response.status === 404) {
                                self.message = error.response.data.message;
                            } else {
                                self.message = error.response.data.error;
                            }
                        })
                }
            },
            watch: {
                referralCode: function (val) {
                    this.referralCode = val;
                    if (val.length === 6
                        && (/^[A-Z0-9]+$/).test(val)
                    ) {
                        this.isValidCode = true;
                    } else {
                        this.isValidCode = false;
                    }
                },
            }
        });
    </script>
</body>
</html>
