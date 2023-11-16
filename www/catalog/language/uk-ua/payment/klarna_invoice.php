<?php
// Text
$_['text_title']				= 'Klarna Invoice - оплата протягом 14 днів';
$_['text_terms_fee']			= '<span id="klarna_invoice_toc"></span> (+%s)<script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\', charge: %s});</script>';
$_['text_terms_no_fee']			= '<span id="klarna_invoice_toc"></span><script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\'});</script>';
$_['text_additional']			= 'Системі Klarna Invoice необхідні деякі додаткові дані для подальшої обробки замовлення.';
$_['text_male']					= 'Чоловік';
$_['text_female']				= 'Жінка';
$_['text_year']					= 'Рік';
$_['text_month']				= 'Місяць';
$_['text_day']					= 'День';
$_['text_comment']				= 'Klarna\'s Invoice ID: %s. ' . "\n" . '%s/%s: %.4f';

// Entry
$_['entry_gender']				= 'Стать';
$_['entry_pno']					= 'Персональний номер';
$_['entry_dob']					= 'Дата народження';
$_['entry_phone_no']			= 'Телефон';
$_['entry_street']				= 'Вулиця';
$_['entry_house_no']			= 'Будинок №.';
$_['entry_house_ext']			= 'Будинок.';
$_['entry_company']				= 'Реєстраційний номер компанії';

// Help
$_['help_pno']					= 'Будь ласка, введіть ваш номер соціального страхування тут.';
$_['help_phone_no']				= 'Будь ласка, введіть номер Вашого телефону.';
$_['help_street']				= 'Будь ласка, зверніть увагу, що доставка може здійснитися тільки на адресу, зареєстровану при оплаті через Klarna.';
$_['help_house_no']				= 'Будь ласка, введіть номер Вашого будинку.';
$_['help_house_ext']			= 'Будь ласка, вкажіть тут корпус/будинок, в якому Ви проживаєте.';
$_['help_company']				= 'Будь ласка, введіть реєстраційний номер Вашої компанії';

// Error
$_['error_deu_terms']			= 'Ви повинні погодитися з політикою конфіденційності Klarna';
$_['error_address_match']		= 'Адреси платника і отримувача замовлення повинні збігатися, якщо Ви хочете використовувати Klarna Invoice';
$_['error_network']				= 'Сталася помилка при підключенні до Klarna. Будь ласка, спробуйте пізніше.';