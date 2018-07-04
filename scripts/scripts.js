//frontend scripts


//menu mobile para o dashboard
const mobileMenuButton = document.querySelector("#mobile-menu");
const leftSection = document.querySelector("#left-section");

let open = false;


//limitação: se o ecran for diminuido e se esconder o menu mobile, ao voltar a alargar ao ecran ele continua escondido
mobileMenuButton.addEventListener("click", () => {	
		if(!open) {
			leftSection.style.display = 'flex';
			open = true;
		} else if (open) {
			leftSection.style.display = 'none';
			open = false;
		}
});
