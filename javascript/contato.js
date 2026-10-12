// pega todos os elementos do formulario e dos campos
const form = document.querySelector("#contact-form");
const nameInput = document.querySelector("#name");
const emailInput = document.querySelector("#email");
const subjectInput = document.querySelector("#subject");
const messageInput = document.querySelector("#message");

// pega o elemento onde vai aparecer a mensagem de sucesso ou erro
const formMessage = document.querySelector("#form-message");

// quando a pessoa clicar em enviar o formulario, roda essa funcao
form.addEventListener("submit", async function (event) {

    // impede que a pagina recarregue (comportamento padrao do form)
    event.preventDefault();

    // pega o valor do campo de nome e tira espacos no inicio e no fim
    const name = nameInput.value.trim();
    // faz a mesma coisa com o e-mail
    const email = emailInput.value.trim();
    // pega o assunto (nao usa trim porque e um select)
    const subject = subjectInput.value;
    // pega a mensagem e tira espacos extras
    const message = messageInput.value.trim();

    // Remove mensagens anteriores
    formMessage.classList.remove("success", "error");

    // Validação do nome
    if (name === "") {
        formMessage.textContent = "Por favor, informe seu nome.";
        formMessage.classList.add("error");
        nameInput.focus();
        return;
    }

    // Validação do e-mail
    if (email === "") {
        formMessage.textContent = "Por favor, informe seu e-mail.";
        formMessage.classList.add("error");
        emailInput.focus();
        return;
    }

    // Validação do formato do e-mail
    if (!email.includes("@") || !email.includes(".")) {
        formMessage.textContent = "Digite um e-mail válido.";
        formMessage.classList.add("error");
        emailInput.focus();
        return;
    }

    // Validação do assunto
    if (subject === "") {
        formMessage.textContent = "Selecione o assunto da mensagem.";
        formMessage.classList.add("error");
        subjectInput.focus();
        return;
    }

    // Validação da mensagem
    if (message === "") {
        formMessage.textContent = "Escreva sua dúvida ou sugestão.";
        formMessage.classList.add("error");
        messageInput.focus();
        return;
    }

    // Se passou nas validacoes, envia os dados para o PHP
    try {
        const resposta = await fetch(form.action, {
            method: "POST",
            body: new FormData(form)
        });

        const texto = (await resposta.text()).trim();

        // o PHP deve devolver a palavra "sucesso" quando o INSERT der certo
        if (resposta.ok && texto.toLowerCase().includes("sucesso")) {
            formMessage.textContent =
                "Mensagem enviada com sucesso! Obrigado pela sugestão.";
            formMessage.classList.add("success");
            form.reset();
        } else {
            formMessage.textContent =
                "Não foi possível salvar no banco. " + (texto || "Tente novamente.");
            formMessage.classList.add("error");
        }

    } catch (erro) {
        formMessage.textContent =
            "Erro de conexão. Abra a página pelo localhost (XAMPP/WAMP).";
        formMessage.classList.add("error");
        console.error(erro);
    }
});