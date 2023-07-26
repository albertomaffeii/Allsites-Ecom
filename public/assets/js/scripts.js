//Sugere um Slug (URL) para cadastrar uma nova caegoria no painel administrativo
function suggestSlugName($campo) {

	var inputName = document.getElementById($campo).value;

	const convertToSlug = (text) => {
		const a = 'àáäâãèéëêìíïîòóöôùúüûñçßÿœæŕśńṕẃǵǹḿǘẍźḧ·/_,:;'
		const b = 'aaaaaeeeeiiiioooouuuuncsyoarsnpwgnmuxzh------'
		const p = new RegExp(a.split('').join('|'), 'g')
		return text.toString().toLowerCase().trim()
		.replace(p, c => b.charAt(a.indexOf(c))) // Replace special chars
		.replace(/&/g, '-and-') // Replace & with 'and'
		.replace(/[\s\W-]+/g, '-') // Replace spaces, non-word characters and dashes with a single dash (-)
	}

	document.getElementById("slug").value = convertToSlug(inputName);
}

//Sugere um Meta Title
function suggestMetaTitle($campo1, $campo2) {
	var input1 = document.getElementById($campo1).value;
	document.getElementById($campo2).value = input1;
}
