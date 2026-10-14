# Header: Site Title и Navigation

- **Статус:** Черновик
- **Pattern slug:** celestial/header-title-navigation

## Назначение

Простой хедер сайта: название слева, меню справа. Подходит для короткого названия и небольшого меню.

## Состав

Внешний Group full-width с constrained layout ограничивает внутреннюю строку шириной contentSize. Внутренний Group использует flex, space-between и перенос. Site Title не создаёт заголовок H1. Navigation использует мобильное overlay-меню и Page List как начальное содержимое.

## Содержимое

Название берётся из настроек сайта. Page List показывает опубликованные страницы; для проекта можно заменить его выбранными ссылками в Navigation. В pattern нет ID меню и привязки к базе конкретного сайта. На узком экране используется кнопка открытия меню; длинное название может переноситься.

## Зависимости

Стандартные блоки Group, Site Title, Navigation, Page List. Токен spacing 50; contentSize и root padding из theme.json. Дополнительный CSS, PHP-функции и style variations не нужны.

## Перенос и адаптация

Перенести pattern.php в patterns/header-title-navigation.php темы. В parts/header.html подключить celestial/header-title-navigation через core/pattern. Семантический header задаёт template-part в шаблонах. Адаптировать название сайта и содержимое Navigation. Работа темы не зависит от library.

Это обычный файловый pattern; общей частью всех шаблонов является header template part. Pattern сам по себе не синхронизирует отдельно вставленные экземпляры.

## Проверки

2026-10-14: проверены регистрация паттерна, рендер header через WordPress и HTTP-вывод Site Title, Navigation и класса space-between. Проверки мобильного overlay, клавиатуры, длинного названия и редактора ещё не выполнены; статус остаётся «Черновик».
