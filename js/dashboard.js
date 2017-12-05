
var fileList = [];
var iterator = 0;
var tabOpen = 'f';

function downloadRequest(){
  // Check which files are selected
  var collection = document.getElementsByName("checkbox[]");
  var spacer = 0;
  var link;
  var uuid;
  
  // Reset Global
  fileList = [];
  iterator = 0;

  for(var item in collection){
    if(collection[item].checked){
      uuid = collection[item].value;
      link = "./ajax_queries/fileDownload.php?file=".concat(String(uuid));
      fileList.push(link);
      setTimeout(download, spacer);
      spacer += 1000;
    }
  }
}

function download(){
  if(iterator < fileList.length){
    window.location = fileList[iterator];
    iterator += 1;
  }
}

function deleteSomething(){
  
  if(tabOpen === 'h'){
    deleteHistory();
  }
  else{
    deleteFiles();
  }
}

function fetchFiles(){
  
  var type = "POST", url = "./ajax_queries/fileList.php", 
  info = {
     user: sessionStorage.getItem("userID")
  },
  func = function(data){ refreshDataList(data);};
  
  makeAjaxRequest(type, url, info, func);
  
}

function refreshDataList(data){
  // Create new body
  var body = document.createElement("tbody");
  var tr, td;
  
  // Delete old body
  document.getElementById("UserFileTable").removeChild(document.getElementById("userFiles"))
  
  body.setAttribute("id","userFiles");
  
  for(var val in data){
    tr = document.createElement("tr");
    body.appendChild(tr);
    
    td = document.createElement("td");
    td.appendChild(create_checkbox(data[val]['id'], "checkbox[]"));
    tr.appendChild(td);
    td = document.createElement("td");
    td.innerHTML = data[val]['name'];
    tr.appendChild(td);
    td = document.createElement("td");
    td.innerHTML = data[val]['size'];
    tr.appendChild(td);
    td = document.createElement("td");
    td.innerHTML = data[val]['expireDate'];
    tr.appendChild(td);
  }
  
  document.getElementById("UserFileTable").appendChild(body);
}

function deleteFiles(){

  var type = "POST";
  var url = "./ajax_queries/fileDelete.php";
  var info = { delete: getCheckedBoxes('checkbox[]')};
  var func = function(data) {  };
  
  if(info['delete'] === null){
    return;
  }
  
  makeAjaxRequest(type, url, info, func);
  setTimeout(fetchFiles, 1000);
}

function fetchHistory(){
  var type = "POST", url = "./ajax_queries/fileHistory.php", 
  info = {
     user: sessionStorage.getItem("userID")
  },
  func = function(data){ refreshHistoryList(data);};
  
  makeAjaxRequest(type, url, info, func);
}

function deleteHistory(){
  var type = "POST", url = "./ajax_queries/fileHistHide.php", 
  info = {
     hide: getCheckedBoxes("entrySelected[]")
  },
  func = function(data){ };
  
  makeAjaxRequest(type, url, info, func);
  setTimeout(fetchHistory, 1000);
}

function refreshHistoryList(data){
  // Create new body
  var body = document.createElement("tbody");
  var tr, td;
  
  // Delete old body
  document.getElementById("historyTable").removeChild(document.getElementById("historyFiles"))
  
  body.setAttribute("id","historyFiles");
  
  for(var val in data){
    tr = document.createElement("tr");
    body.appendChild(tr);
    
    td = document.createElement("td");
    td.appendChild(create_checkbox(data[val]['id'], "entrySelected[]"));
    tr.appendChild(td);
    td = document.createElement("td");
    td.innerHTML = data[val]['fname'];
    tr.appendChild(td);
    td = document.createElement("td");
    td.innerHTML = data[val]['fsize'];
    tr.appendChild(td);
    td = document.createElement("td");
    td.innerHTML = data[val]['fuploadDate'];
    tr.appendChild(td);
  }
  
  document.getElementById("historyTable").appendChild(body);
}

function shareFile(){
  
  var box = getCheckedBoxes("checkbox[]");
  
  if(box === null)
    return;
  
  // Show user their selection
  for(var i in box){
    sweetAlert("Share this File!", " UUID for sharing : " + box[i], "success");
  }
  
}

function create_checkbox(value, name){
  
  var check = document.createElement("input");
  check.setAttribute("type","checkbox");
  check.setAttribute("name", name);
  check.setAttribute("value",String(value));
  
  return check;
}



function validate(e) {

  if ((typeof e !== "undefined") && (e !== null)) {
      return true;
  }
  else {
      return false;
  }
}

function initialize() {

  var typeOfLogin = sessionStorage.getItem("typeofLogin");
  
  // Load users files
  fetchFiles();
  fetchHistory();
  
  // Check if a user actually signed in
  if(sessionStorage.getItem("userName") !== null){
    document.getElementById("usern").innerHTML = "Hello, " + sessionStorage.getItem("userName");
    document.getElementById("emailID").innerHTML = sessionStorage.getItem("emailID");
  }
  
  if (typeOfLogin == "FacebookLogin") {
      document.getElementById("passwordField").innerHTML = "Account logged" +
          " in from Facebook. Cannot change password " +
          "locally";
      document.getElementById("changePassword").disabled = true;
  }
  else if (typeOfLogin == "gmailLogin") {
      document.getElementById("passwordField").innerHTML = "Account logged" +
          " in from Google Account. Cannot change password " +
          "locally";
      document.getElementById("changePassword").disabled = true;
  }

  gapi.load('auth2', function() {
      gapi.auth2.init();
  });

}

/*function logoutFB() {
  window.fbAsyncInit = function() {
      FB.init({
          appId: '152162102051722', // App ID
          channelUrl: 'https://docdash-aneeshraman.c9users.io/FREndFiles/sessionEnd.php', // Channel File
          status: true, // check login status
          cookie: true, // enable cookies to allow the server to access the session
          xfbml: true // parse XFBML
      });

      // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d) {
      var js, id = 'facebook-jssdk',
          ref = d.getElementsByTagName('script')[0];
      if (d.getElementById(id)) { return; }
      js = d.createElement('script');
      js.id = id;
      js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      ref.parentNode.insertBefore(js, ref);
  }(document));

  FB.logout(function(response) {
      // user is now logged out

  });
}
*/

function checkAll(eName, source) {
  var checkboxes = document.getElementsByName(eName);
  var check = document.getElementById(source).checked;
  for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = check;
  }
}

function changeClass(element, newClass) {
  var x = document.getElementById(element);
  x.setAttribute("class", newClass);
}

function switchClasses(elements, newClass) {
  if (!validate(newClass)) {
      return false;
  }

  for (var e in elements) {
      if (validate(e) && typeof e == "string") {
          changeClass(elements[e], newClass);
      }
  }
}

function toggleVisibilty(element) {
  var x = document.getElementById(element);
  if (x.style.display === "none") {
      x.style.display = "block";
  }
  else {
      x.style.display = "none";
  }
}

function setVisibilty(element, visible) {
  var x = document.getElementById(element);
  if (x.style.display === "none" && visible) {
      x.style.display = "block";
  }
  else {
      x.style.display = "none";
  }
}

function switchVis(elements) {
  for (var e in elements) {
      if (validate(e) && typeof e == "string") {
          toggleVisibilty(elements[e]);
      }
  }
}

function setVis(elements, visible) {
  for (var e in elements) {
      if (validate(e) && typeof e == "string") {
          setVisibilty(elements[e], visible);
      }
  }
}

function tHide(e) {
  var x = document.getElementById(e);
  if (x.style.visibility === "collapse") {
      x.style.visibility = "visible";
  }
  else {
      x.style.visibility = "collapse";
  }
}

function hideElements(elements) {
  for (var e in elements) {
      if (validate(e) && typeof e == "string") {
          tHide(elements[e]);
      }
  }
}

function signO() {
  //var typeOfLogin = sessionStorage.getItem("typeofLogin");
  //alert(typeOfLogin);
  /*if (typeOfLogin == "FacebookLogin") {
      logoutFB();
      FB.logout(function(response) {
          FB.Auth.setAuthResponse(null, 'unknown');
      });
      alert("Signed out of FB");
      //window.open("./login.php","_self");
  }
  else*/// if (typeOfLogin == "gmailLogin") {
      //signOut();
  //}
  //else{}

  signOut();
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function() {
      sessionStorage.clear();
      window.open("./sessionEnd.php", "_self");
  });
  sessionStorage.clear();
      window.open("./sessionEnd.php", "_self");
}

function attachCallback() {
  var items = document.getElementsByClassName("hidden-xs");
  for (var i = 0; i < items.length; i++) {
      if (items[i].textContent == "Remove") {
          var clickClear = function() { items[i].onclick(); };
      }
  }
  for (var i = 0; i < items.length; i++) {
      if (items[i].textContent == "Upload") {
          items[i].onclick = function() {
              docUpload();
              changeClass("input-b2", "file-caption form-control kv-fileinput-caption");
          };
      }
      else if (items[i].textContent == "Cancel") {
          items[i].onclick = function() {
              docCancel();
              changeClass("input-b2", "file-caption form-control kv-fileinput-caption");
          };
      }
  }
}

function docUpload() {
  filesClick();
}

function docCancel() {
  filesClick();
}

function bind(elements) {
  var collect = {};
  var activate = false;
  var classChange = "";

  collect.folder = elements;
  collect.open = function(index) {
      var indexIT = false;
      for (var i = 0; i < collect.folder.length; i++) {
          if (index == i) {
              activate = true;
              classChange = "nav-link active"
          }
          else {
              activate = false;
              classChange = "nav-link"
          }
          indexIT = false;
          switch (collect.folder[i].length) {
              case 0:
                  continue;
              case 3:
                  if (activate) {
                      document.getElementById(collect.folder[i][1]).onclick = null;
                  }
                  else {
                      document.getElementById(collect.folder[i][1]).onclick = collect.folder[i][2];
                  }
              case 2:
                  changeClass(collect.folder[i][1], classChange) // 1
                  indexIT = true;
              case 1:
                  if (indexIT) { setVisibilty(collect.folder[i][0], activate); }
                  else { setVisibilty(collect.folder[i], activate); }
          }
      }
  };
  return collect;
}

var collection = new bind([
  ["Dashboard", "fileListLink", function() { filesClick(); }],
  ["settings", "settingListLink", function() { settingsClick(); }],
  ["uploadFile"],
  ["goPro", "goProLink", function() { proClick(); }]
]);

var tabs = new bind([
  ["fileList", "actLink", function() { activeClick(); }],
  ["history", "hisLink", function() { historyClick(); }]
]);

// Nav Functions
function filesClick() {
  collection.open(0)
}

function settingsClick() {
  collection.open(1);
}

function uploadClick() {
  collection.open(2);
  attachCallback();
}

function proClick() {
  collection.open(3);
}

// Tab Functions
function historyClick() {
  tabs.open(1);
  switchVis(["fileListTitle", "historyTitle"]);
  switchVis(["divDownload", "divUpload", "divShare"]);
  tabOpen = 'h';
}

function activeClick() {
  tabs.open(0);
  switchVis(["fileListTitle", "historyTitle"]);
  switchVis(["divDownload", "divUpload", "divShare"]);
  tabOpen = 'f';
}
