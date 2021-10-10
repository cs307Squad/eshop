function showPassword() {
	var pword = document.getElementById("pword")
	if (pword.type === "password") {
		pword.type = "text";
		document.getElementById('shown').style.display = "initial";
		document.getElementById('hidden').style.display = "none";
		} else {
			pword.type = "password";
			document.getElementById('shown').style.display = "none";
			document.getElementById('hidden').style.display = "initial";
			}
}