# Icon

Коллекция Lucide регистрируется плагином; оформление core/icon задаёт тема.

| Стиль | Рисунок | Контейнер |
| --- | --- | --- |
| Plain (по умолчанию) | 2rem, contrast | Без подложки |
| Circle | 2rem, base | 4.5rem, primary, круг |
| Rounded square | 2rem, base | 4.5rem, primary, радиус 0.5rem |

Размеры находятся в theme.json settings.custom.icon; базовый цвет в styles.blocks.core/icon. CSS assets/blocks/icon.css подключён через wp_enqueue_block_style для редактора и сайта. functions.php регистрирует plain, circle и rounded-square. Пример: `<!-- wp:icon {"icon":"lucide/check","className":"is-style-circle"} /-->`.

Controls дизайна не включаются. При доступном выборе зарегистрированных стилей можно выбрать готовый вариант; паттерны задают класс заранее. Для смысловых иконок без текста нужен ariaLabel. Цвет base/primary проверять после изменения палитры. Иконки с явно сохранёнными inline-настройками могут отличаться от базового оформления.

Проверки: три стиля зарегистрированы и проходят серверный SVG-рендер; токены размеров и CSS выдаются на главной. Визуальная проверка всех вариантов в редакторе ещё не выполнена.
