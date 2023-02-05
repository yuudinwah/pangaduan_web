async function authGet() {
  const response = await fetch('http://localhost:8000/api/auth/get', {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },
  });
  console.log(checkLogin())
  var data = await response.json();
  if (response.status === 200) {
    return data.data
  } else {
    console.log('User not found')
    return null
  }
}

async function caseAdd({ userID, name, email, title, detail }) {
  const response = await fetch('http://localhost:8000/api/case/add', {
    method: "POST",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },
    body: JSON.stringify({
      userID: userID,
      name: name,
      email: email,
      title: title,
      detail: detail
    })
  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('Case not found')
    return null
  }
}

async function caseFetch() {
  const response = await fetch('http://localhost:8000/api/case/fetch', {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },

  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('Case not found')
    return null
  }
}

async function caseGet(id) {
  const response = await fetch(`http://localhost:8000/api/case/get?id=${id}`, {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },

  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('Case not found')
    return null
  }
}

async function caseUpdate(id, { name, email, title, detail, status }) {
  const response = await fetch(`http://localhost:8000/api/case/update`, {
    method: "PUT",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },
    body: JSON.stringify({
      id: id,
      name: name,
      email: email,
      title: title,
      detail: detail,
      status: status
    })
  });
  var data = await response.json();
  if (response.status === 200) {
    return data.data
  } else {
    return null
  }
}

async function caseResponseAdd({ userID, caseID, caseResponse }) {
  const response = await fetch('http://localhost:8000/api/case-response/add', {
    method: "POST",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },
    body: JSON.stringify({
      userID: userID,
      caseID: caseID,
      response: caseResponse
    })
  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('Case not found')
    return null
  }
}

async function caseResponseFetch(id) {
  const response = await fetch(`http://localhost:8000/api/case-response/fetch?id=${id}`, {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },

  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('Case not found')
    return null
  }
}

function checkLogin() {
  return cookieGet("token")
}

function cookieDelete(cname) {
  document.cookie = `${cname}= ; expires = Thu, 01 Jan 1970 00:00:00 GMT`
}

function cookieSave(cname, value, expires) {
  document.cookie = `${cname}=${value}; expires=${expires}; path=/`;
}

function cookieGet(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1);
    if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
  }
  return "";
}

async function dashboardGet() {
  const response = await fetch('http://localhost:8000/api/dashboard/admin', {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },

  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('Dashboard not found')
    return null
  }
}

async function logFetch() {
  const response = await fetch('http://localhost:8000/api/log/fetch', {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },

  });
  var data = await response.json();
  if (response.status === 200) {
    return data.data
  } else {
    return null
  }
}

async function signin() {
  console.log('hallo')
  const buttonSubmit = document.getElementById('submit-button')
  buttonSubmit.innerHTML = `${signinLoading()}`
  const response = await fetch('http://localhost:8000/api/auth/login', {
    method: "POST",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      "email": document.getElementById('email').value,
      "password": document.getElementById('password').value,
    })
  });
  var data = await response.json();
  buttonSubmit.innerHTML = `${signinButton()}`

  if (response.status === 200) {
    data = data.data
    document.cookie = `token=${data.token}; expires=0; path=/`;
    window.location.href = `./dashboard`;
  } else {
    alert(data.message)
  }
}

async function signup() {
  console.log('hallo')
  const buttonSubmit = document.getElementById('submit-button')
  buttonSubmit.innerHTML = `<svg aria-hidden="true"
    class="inline-block w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path
      d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
      fill="currentColor" />
    <path
      d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
      fill="currentFill" />
  </svg>`
  const response = await fetch('http://localhost:8000/api/auth/login', {
    method: "POST",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      "email": document.getElementById('email').value,
      "password": document.getElementById('password').value,
    })
  });
  var data = await response.json();

  if (response.status === 200) {
    data = data.data
    document.cookie = `token=${data.token}; expiredAt=${data.expiredAt}; expires=0; path=/`;
    window.location.href = `./dashboard`;
  } else {
    alert(data.message)
  }
}

async function signout() {
  cookieDelete('token')
  window.location.href = './'
}

async function userAdd({ name, email, username, password }) {
  const response = await fetch(`http://localhost:8000/api/user/add`, {
    method: "POST",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: name,
      email: email,
      username: username,
      password: password,
    })
  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('User not found')
    return null
  }
}

async function userGet(userID) {
  const response = await fetch(`http://localhost:8000/api/user/get?id=${userID}`, {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json'
    },

  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('User not found')
    return null
  }
}

async function userFetch() {
  const response = await fetch('http://localhost:8000/api/user/fetch', {
    method: "GET",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json',
      'token': checkLogin()
    },

  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('User not found')
    return null
  }
}

async function userDelete(userID) {
  const response = await fetch(`http://localhost:8000/api/user/delete`, {
    method: "DELETE",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      id: userID,
    })
  });
  var data = await response.json();
  if (response.status === 200) {
    return data.data
  } else {
    console.log('User not found')
    return null
  }
}

async function userUpdate(userID, { name, email, username, password, handphone, status }) {
console.log({
  "id": userID,
  "name": name,
  "email": email,
  "username": username || email,
  "password": password,
  "handphone": handphone || email,
  "status": status || 'active'
})
  const response = await fetch(`http://localhost:8000/api/user/update`, {
    method: "PUT",
    // mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Accept': 'application.json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      "id": userID,
      "name": name,
      "email": email,
      "username": username || email,
      "password": password,
      "handphone": handphone || email,
      "status": status || 'active'
    })
  });
  var data = await response.json();
  console.log(data)
  if (response.status === 200) {
    return data.data
  } else {
    console.log('User not found')
    return null
  }
}

function signinLoading() {
  return `<svg aria-hidden="true"
      class="inline-block w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
      viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path
          d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
          fill="currentColor" />
      <path
          d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
          fill="currentFill" />
  </svg>`
}

function signinButton() {
  return `<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
      class="inline-block w-4 h-4 mr-2 bi bi-box-arrow-in-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd"
          d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z">
      </path>
      <path fill-rule="evenodd"
          d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z">
      </path>
  </svg>Masuk`
}