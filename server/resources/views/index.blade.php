<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920px, initial-scale=1.0">
    <title>SkillsMe Star Wars Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <form>
    <input type="hidden" id="user_email" name="email" value="{{!empty(session('email'))?session('email'):0}}" />
    <input type="hidden" id="user_id" name="id" value="{{!empty(session('userId'))?session('userId'):0}}" />
    </form>
    <div id="signinButtonDiv">
        @if(!empty(session('email')))
        <button class="btn btn-danger" onclick="logout()">Logout</button>
        @else
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Sign in</button>
        @endif
    </div>
    <ul class="row list-unstyled p-3">
    @foreach($people as $person)
     <li class="col-3 pt-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$person->name}}</h5>
                <p class="card-text">Height: {{$person->height}}</p>
                <p class="card-text">Mass: {{$person->mass}}</p>
                <p class="card-text">Hair Color: {{$person->hair_color}}</p>
                <p class="card-text">Skin Color: {{$person->skin_color}}</p>
                <p class="card-text">Eye Color: {{$person->eye_color}}</p>
                <p class="card-text">Birth Year: {{$person->birth_year}}</p>
                <p class="card-text">Gender: {{$person->gender}}</p>
                <button type="button" class="btn btn-primary w-100" onclick="vote({{$person->id}})">Vote</button> 
            </div>
        </div>
    </li>
    @endforeach
    </ul>
    <div class="modal" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/signin" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-3">Email: </label>
                            <input class="col-9" type="email" name="email" id="signinEmail"/>
                        </div>
                        <div class="row">
                            <label class="col-3">Password: </label>
                            <input class="col-9" type="password" name="password" id="signinPassword"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeLoginBtn">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
                        <button type="button" class="btn btn-success" onclick="login()">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="signupModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/signin" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-3">Email: </label>
                            <input class="col-9" type="email" name="email" id="signupEmail" />
                        </div>
                        <div class="row">
                            <label class="col-3">Password: </label>
                            <input class="col-9" type="password" name="password" id="signupPassword"/>
                        </div>
                        <div class="row">
                            <label class="col-3">Confirm Password: </label>
                            <input class="col-9" type="password" name="confirmPassword" id="signupConfirmPassword"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeSignupBtn" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</button>
                        <button type="button" class="btn btn-success" onclick="signup()">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
    const logout = () => {
        location.href="/logout";
    }
    const login = () => {
        let email = document.getElementById("signinEmail").value;
        let password = document.getElementById('signinPassword').value;
        let csrftoken = document.getElementsByName('_token')[0].value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = (event) => {
            if(event.target.readyState == 4 && event.target.status == 200){
                let response = JSON.parse(event.target.responseText);
                document.getElementById('user_email').value = response.email;
                document.getElementById('user_id').value = response.userId;
                document.getElementById('signinButtonDiv').innerHTML = `<button class="btn btn-danger" onclick="logout()">Logout</button>`;
                document.getElementById('closeLoginBtn').click();
            }else if(event.target.readyState == 4 && event.target.status == 401){
                let response = JSON.parse(event.target.responseText);
            }
        }
        xhttp.open('POST','/signin',true);
        xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xhttp.send(`email=${email}&password=${password}&_token=${csrftoken}`);
    }
    const signup = () => {
        let email = document.getElementById("signupEmail").value;
        let password = document.getElementById("signupPassword").value;
        let confirmPassword = document.getElementById("signupConfirmPassword").value;
        let csrftoken = document.getElementsByName('_token')[0].value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = (event) => {
            if(event.target.readyState == 4 && event.target.status == 200){
                let response = JSON.parse(event.target.responseText);
                document.getElementById('user_email').value = response.email;
                document.getElementById('user_id').value = response.userId;
                document.getElementById('signinButtonDiv').innerHTML = `<button class="btn btn-danger" onclick="logout()">Logout</button>`;
                document.getElementById('closeSignupBtn').click();
                document.getElementById('closeLoginBtn').click();
            }else if(event.target.readyState == 4 && event.target.status == 401){
                let response = JSON.parse(event.target.responseText);

            }
        }
        xhttp.open('POST','/signup',true);
        xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xhttp.send(`email=${email}&password=${password}&confirmPassword=${confirmPassword}&_token=${csrftoken}`);
    }
    const vote = (id) => {
        let userId = document.getElementById("user_id").value;
        let csrftoken = document.getElementsByName('_token')[0].value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = (event) => {};
        xhttp.open('GET',`/vote?personId=${id}&userId=${userId}&_token=${csrftoken}`,true);
        xhttp.send();
    }
</script>
</html>