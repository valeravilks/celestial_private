# Галерея секций для отбора

На главной локального сайта показаны 38 независимых секций. Это рабочие кандидаты для визуального отбора, а не утверждённая библиотека. Назвать номера понравившихся вариантов; переносить только после явного запроса владельца. Нумерация этой подборки стабильна.

## Состав

| № | Композиция | Исходник |
| --- | --- | --- |
| 01 | Content: редакционное вступление | [patterns/content-editorial-intro.php](../patterns/content-editorial-intro.php) |
| 02 | Content: изображение слева | [patterns/content-image-left.php](../patterns/content-image-left.php) |
| 03 | Content: изображение справа | [patterns/content-image-right.php](../patterns/content-image-right.php) |
| 04 | Content: две фотографии с подписями | [patterns/content-two-images-captions.php](../patterns/content-two-images-captions.php) |
| 05 | Content: крупное изображение и пояснение | [patterns/content-featured-image.php](../patterns/content-featured-image.php) |
| 06 | Benefits: три простых преимущества | [patterns/benefits-three-plain.php](../patterns/benefits-three-plain.php) |
| 07 | Benefits: три преимущества с круглыми иконками | [patterns/benefits-three-circles.php](../patterns/benefits-three-circles.php) |
| 08 | Benefits: шесть компактных карточек | [patterns/benefits-six-cards.php](../patterns/benefits-six-cards.php) |
| 09 | Benefits: главный тезис и список | [patterns/benefits-feature-and-list.php](../patterns/benefits-feature-and-list.php) |
| 10 | Benefits: четыре коротких тезиса | [patterns/benefits-four-compact.php](../patterns/benefits-four-compact.php) |
| 11 | Services: три карточки направлений | [patterns/services-three-cards.php](../patterns/services-three-cards.php) |
| 12 | Services: редакционный список направлений | [patterns/services-editorial-rows.php](../patterns/services-editorial-rows.php) |
| 13 | Services: два сценария выбора | [patterns/services-two-paths.php](../patterns/services-two-paths.php) |
| 14 | Process: четыре шага в ряд | [patterns/process-four-steps.php](../patterns/process-four-steps.php) |
| 15 | Process: вертикальная последовательность | [patterns/process-vertical-steps.php](../patterns/process-vertical-steps.php) |
| 16 | Process: подготовка и чек-лист | [patterns/process-checklist.php](../patterns/process-checklist.php) |
| 17 | Comparison: два подхода | [patterns/comparison-two-approaches.php](../patterns/comparison-two-approaches.php) |
| 18 | Content: состав результата | [patterns/content-scope-two-columns.php](../patterns/content-scope-two-columns.php) |
| 19 | FAQ: раскрывающиеся вопросы | [patterns/faq-accordion.php](../patterns/faq-accordion.php) |
| 20 | FAQ: открытые ответы в двух колонках | [patterns/faq-two-column-answers.php](../patterns/faq-two-column-answers.php) |
| 21 | Testimonials: редакционная цитата | [patterns/testimonial-editorial.php](../patterns/testimonial-editorial.php) |
| 22 | Testimonials: две карточки отзывов | [patterns/testimonials-two-cards.php](../patterns/testimonials-two-cards.php) |
| 23 | Case: задача и решение | [patterns/case-problem-solution.php](../patterns/case-problem-solution.php) |
| 24 | Audience: три сценария использования | [patterns/audience-three-scenarios.php](../patterns/audience-three-scenarios.php) |
| 25 | Support: информация и помощь | [patterns/support-two-levels.php](../patterns/support-two-levels.php) |
| 26 | CTA: центрированный призыв | [patterns/cta-centered.php](../patterns/cta-centered.php) |
| 27 | CTA: текст и действие в двух колонках | [patterns/cta-split-action.php](../patterns/cta-split-action.php) |
| 28 | CTA: акцентная панель | [patterns/cta-panel.php](../patterns/cta-panel.php) |
| 29 | Resources: три полезных материала | [patterns/resources-three-links.php](../patterns/resources-three-links.php) |
| 30 | Contact: приглашение и список вводных | [patterns/contact-brief.php](../patterns/contact-brief.php) |

## Где что хранится

- Исходники — отдельные PHP patterns в теме; используются штатные блоки WordPress и установленные Lucide. Новый кастомный блок не создавался.
- Номера, якоря, демонстрационные ссылки и содержание подборки находятся только в экземплярах главной и docs/section-gallery-page.html. Сами переиспользуемые patterns не содержат номеров галереи, фиксированных якорей или ID сайта. Перед использованием их кнопкам нужно назначить ссылку.
- docs/section-gallery-catalog.json связывает номер с исходником; section-gallery-icons.json перечисляет использованные Lucide.
- Все секции: вводная Group с Subtitle/H2 (gap20), отдельная Group содержимого, gap60 между ними, padding70. Общая Group страницы имеет gap0. Это соответствует принятой иерархии расстояний.
- Пример отзывов и разбор кейса обозначены как демонстрационные; фотографии — ранее загруженные Unsplash-референсы, не выполненные проекты. Источники изображений описаны в furniture-demo.md.
- Собственный CSS: assets/blocks/group.css — центрирование двух CTA и отступ якорей; изображения и иконки используют установленные стили темы. Дизайн-controls не включались. Тема работает без сборки.
- Контент главной живёт в базе. Файлы patterns и HTML-снимок не обновляют вставленные экземпляры автоматически. Меню обновлено для переходов к группам секций и записи с оглавлением.

## Сохранённая главная и восстановление

Перед заменой сохранены docs/backups/2026-10-15-before-section-gallery/front-page.html и state.json: исходная страница, её ID, настройки front page и содержимое меню. Это копия локального демонстрационного содержимого; полный экспорт базы не заменяет.

Для восстановления из wordpress/ выполнить wp-env run cli wp eval с чтением JSON через get_theme_file_path("docs/backups/2026-10-15-before-section-gallery/state.json"). Восстановить post_title, post_content и post_excerpt записи state.front.ID через wp_update_post; вернуть содержимое и названия меню из state.navigation и значения page_on_front/show_on_front. Не удалять исходные patterns: в текущей задаче они не менялись.

## Основания композиции

Использованы смысловые заголовки, небольшие группы текста и заметное разделение секций. Это согласуется с наблюдениями о сканировании заголовков в исследовании [NN/g: Layer-Cake Pattern](https://www.nngroup.com/articles/layer-cake-pattern-scanning/). Это основание для организации, а не доказательство эффективности каждого кандидата.

Для набора композиций изучены штатные примеры [WordPress: Call to Action](https://learn.wordpress.org/lesson/creating-a-call-to-action/) и [трёхколоночная композиция](https://en-gb.wordpress.org/patterns/pattern/three-column-layouts-heading-paragraph-button/). Разметка написана для действующих токенов проекта; сторонние patterns и CSS не импортировались.

## Проверки и границы

Серверный рендер: первоначальные 30 секций, номера01–30, один H1, уникальные ID, существующие цели внутренних ссылок, alt у изображений. Проверены manifest и наличие SVG всех 24 использованных Lucide; в рендере присутствуют 37 SVG-иконок. На desktop1910px нет горизонтального переполнения. При открытии редактора обнаружено несоответствие атрибутов шести изображений; оно исправлено в новых patterns и снимке главной. Полный цикл изменения и сохранения каждой секции в редакторе не выполнен. Раскрытие первого вопроса FAQ проверено в браузере. Переключатель viewport не изменил фактическую ширину браузера: точная мобильная ширина и клиентские ограничения contentOnly требуют отдельной проверки перед переносом выбранных вариантов.

Новый ADR не создавался: это наполнение рабочего проекта в рамках существующих правил. Первоначальная подборка создавалась без изменения Library. После отбора 2026-10-15 добавлены 15 новых библиотечных записей; см. section-gallery-review.md.

## Вторая итерация: отбор и CTA 31–38

[Результат отбора](section-gallery-review.md): перенесены №05, 07, 08, 10, 13, 14, 16, 18, 20, 22, 24, 25, 26, 29 и 30. В №13 обе кнопки удалены в теме и текущей странице до переноса. Существующие библиотечные файлы не менялись. №04 и №06 имеют существующие аналоги; повторно не переносились.

На главной после исходных 30 вариантов добавлены CTA 31–38. Они ещё не приняты и находятся только в wordpress/theme/patterns. Тёмные варианты используют contrast или primary с текстом base; кнопки — base/contrast. Светлый вариант с тёмной панелью использует celestial-dark-panel. Дополнительные правила Group обеспечивают контраст Subtitle и иконок; токены палитры и ширины не менялись.

Демонстрационные ссылки CTA 31–38 возвращают к началу подборки; отправка обращений не реализована.

Проверка второй итерации: сервер отдаёт 38 секций с уникальными ID и рабочими якорями; в №13 нет кнопок. Контраст base/contrast 13.64:1 и base/primary 9.52:1; акцентные точки также проходят 3:1 на обоих тёмных фонах. В браузере проверены фактические цвета тёмных секций и отсутствие горизонтального переполнения. Точная мобильная проверка и полный редакторский цикл остаются незавершёнными.

## Убраны сохранённые композиции

По следующему запросу владельца №31, 32 и 38 добавлены новыми записями в библиотеку. Все 18 сохранённых секций убраны только из содержимого главной. Их исходники patterns остаются в теме. Существующие записи library не изменялись.

На главной осталось 20 вариантов с исходными номерами: 01, 02, 03, 04, 06, 09, 11, 12, 15, 17, 19, 21, 23, 27, 28, 33, 34, 35, 36, 37. Быстрые переходы обновлены; демонстрационные кнопки теперь возвращают к началу, без ссылок на убранные секции. Текущий список — section-gallery-visible.json; полный каталог сохраняет историю всех 38 номеров.

Перед очисткой сохранена дополнительная копия главной и меню в backups/2026-10-15-before-removing-promoted. Это демонстрационный материал; не заменяет полный экспорт базы.
