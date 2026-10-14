# Icon

- **Блок:** core/icon
- **Коллекция:** Lucide, встроенный модуль Celestial

Plain — базовый контракт, без подложки. Circle и Rounded square — две самостоятельные style variations: их можно использовать вместе. Default обозначает первую сохранённую реализацию каждой variation, а не отдельный стиль. При последующих альтернативах выбирается одна реализация каждой variation.

## Установка

Перенести base.css в assets/blocks/icon.css темы, добавить CSS нужных вариантов, подключить итоговый файл через wp_enqueue_block_style для core/icon. Из base.json перенести settings.custom.icon и базовый styles.blocks.core/icon в theme.json, сохраняя остальные настройки. Зарегистрировать нужные стили circle и rounded-square через register_block_style; plain можно зарегистрировать как is_default. Каждый style.json описывает свойства своего варианта; файлы библиотеки не подключаются во время работы сайта.

Используются классы is-style-circle и is-style-rounded-square. SVG и их регистрация остаются в плагине; collection lucide обязателен. Не переносить всю библиотеку и не включать controls дизайна.

## Варианты

- [Plain](plain/description.md) — 2rem, contrast, без подложки.
- [Circle](circle/default/description.md) — рисунок 2rem/base, круг 4.5rem/primary.
- [Rounded square](rounded-square/default/description.md) — рисунок 2rem/base, квадрат 4.5rem/primary, радиус 0.5rem.

Размеры зависят от корневого шрифта. Проверять контраст после адаптации палитры, доступные подписи смысловых иконок и сохранённые inline-настройки. Текущий набор перенесён из проекта по явному запросу владельца; проверка в проекте не гарантирует корректность на всех новых сайтах.
