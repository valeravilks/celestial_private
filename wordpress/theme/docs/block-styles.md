# Дополнительные CSS-файлы блоков

Базовые свойства и токены задаются в `theme.json`, визуальные варианты блоков — в JSON style variations. Если для оформления нужны сложные селекторы, состояния, media queries или анимации, использовать отдельный готовый CSS-файл. Сборка темы не требуется.

## Подключение CSS

Функция `celestial_theme_register_block_styles()` в `functions.php` на хуке `init` вызывает `wp_enqueue_block_style()` для перечисленных Core-блоков.

```text
button → core/button → assets/blocks/button.css → celestial-button
```

В списке подключены `button`, `paragraph` и `icon`. Файл `assets/blocks/button.css` пустой: это точка расширения без новых визуальных правил. `group` из старого проекта не подключён, пока у него нет собственного CSS-файла.

## Добавление блока

1. Создать `assets/blocks/<block-name>.css`, например `group.css`.
2. Добавить имя без `core/` в `$styled_blocks` в `functions.php`:

   ```php
   $styled_blocks = array( 'button', 'group' );
   ```

3. Использовать токены темы и ограничить селекторы нужным блоком или style variation.
4. Проверить оформление в редакторе и на сайте, включая состояния и мобильную ширину.

`src` задаёт URL файла, `path` — его локальный путь для оптимизации загрузки WordPress. Файл связывается с блоком; конкретный способ загрузки или встраивания CSS определяется WordPress и текущим контекстом рендера.

## CSS и style variations

Подключение CSS не регистрирует новый визуальный вариант в редакторе. Для варианта сначала требуется отдельная регистрация, например JSON с `blockTypes`, `slug`, `title` и `styles` в `styles/blocks/<block-name>/`.

Дополнительный CSS ограничивать классом варианта и нужным внутренним элементом. Например, для будущего варианта `button-link`:

```css
.wp-block-button.is-style-button-link .wp-element-button::after {
  content: '→';
  margin-inline-start: var(--wp--preset--spacing--20);
}
```

Это пример для будущей реализации: сейчас `button-link` не зарегистрирован, правило не добавлено в `button.css`. Не дублировать в CSS цвета, размеры и отступы, которые уже корректно определены JSON. При анимации учитывать `prefers-reduced-motion`.

Стиль Paragraph Subtitle зарегистрирован с именем subtitle. assets/blocks/paragraph.css задаёт выбранное оформление: sm, bold, wide, snug; текст цвета muted и декоративная круглая точка primary перед ним. Размер точки и промежуток — spacing 20. Паттерн «Features: шесть пунктов с иконками» использует этот стиль и шесть декоративных Lucide.

В information-six-items Subtitle и H2 объединены Group с blockGap spacing 20; до колонок используется spacing 50. Это правило композиции паттерна, а не глобальный отступ текстового стиля.

[Оформление Icon](blocks/icon.md): Plain, Circle и Rounded square; готовый CSS assets/blocks/icon.css.

В information-six-items оба ряда колонок объединены отдельной Group содержимого: gap между рядами spacing 50. Корневая секция содержит вводную Group и Group контента; иерархия — spacing 20 < spacing 50 ≤ padding spacing 70.

В information-six-items межгрупповой gap увеличен до spacing 60 (2rem): вводная группа сохраняет 20, расстояние между рядами — 50, padding секции — 70.
