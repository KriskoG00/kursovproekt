<?php
function handleFAQForm()
{
    $errors = [];
    $successMessage = '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty(trim($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Моля, въведете валиден имейл.';
        }
        if (empty(trim($message))) {
            $errors[] = 'Моля, въведете съобщение.';
        }

        if (empty($errors)) {
            $successMessage = "Благодарим за вашето запитване!. Ще получите отговор на имейл: $email.";
            $email = $message = '';
        }
    }

    return [$errors, $successMessage, $email, $message];
}

list($errors, $successMessage, $email, $message) = handleFAQForm();
?>

<div class="container">
    <h1 class="text-center mt-4">Често задавани въпроси</h1>

    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Как да осиновя животно?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    За да осиновите животно, трябва да попълните формуляр за осиновяване, който ще намерите на нашия сайт. След като получите одобрение, ще се свържем с вас и ще организираме среща с животното.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Как да стана доброволец?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ако искате да станете доброволец, моля попълнете формуляра за доброволци на нашия сайт и нашият екип ще се свърже с вас, за да обсъдим подробности.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Какво се случва след като осиновя животно?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    След като осиновите животно, ще трябва да подпишете договор за осиновяване, който гарантира, че ще се грижите за животното. Ще получите и информация за храненето и грижите за него. Нашият екип ще остане на разположение за всякакви въпроси.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Как мога да даря средства за животните?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Можете да направите дарение през нашия сайт, като използвате формата за дарения. Ще имате възможност да изберете сума и начин на плащане (кредитна/дебитна карта или банков превод).
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Какво да правя, ако животното ми се разболее след осиновяването?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ако животното се разболее след осиновяването, моля свържете се с нас незабавно. Нашите партньори ветеринари ще предоставят необходимото лечение и ще ви предоставят съвети за грижите, които трябва да полагате.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Какво трябва да направя, ако вече не мога да се грижа за животното?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ако поради някаква причина не можете да се грижите за животното, моля свържете се с нас възможно най-скоро. Ще обсъдим как можем да ви помогнем и дали животното може да бъде върнато при нас за осиновяване отново.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Какви са условията за осиновяване на животно?
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    За да осиновите животно, трябва да попълните онлайн формуляр и да преминете през интервю с нашия екип. Ние ще проверим дали имате подходящи условия за отглеждане на животно. Условията включват пространство, време и средства за грижи за животното.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Как да стана част от нашата общност?
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Можете да станете част от нашата общност като се абонирате за нашия бюлетин, да следвате нашите социални медии или да станете доброволец. Всеки принос е ценен!
                </div>
            </div>
        </div>
    </div>