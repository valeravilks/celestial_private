# Blocks

Каталог вариантов оформления существующих блоков WordPress. Это не исходники новых типов блоков: собственные функциональные блоки разрабатываются в плагине проекта.

```text
paragraph/                       # core/paragraph
└── subtitle/                    # Style variation: subtitle
    ├── README.md                # Назначение и общий контракт
    ├── dot/                     # Возможная реализация с точкой
    │   ├── description.md
    │   ├── style.json
    │   └── style.css            # При необходимости
    └── line/                    # Возможная реализация с линией
        ├── description.md
        └── style.json
```

`dot/` и `line/` показаны как будущие примеры; их файлов пока нет. В каталог добавлена только [карточка Subtitle](paragraph/subtitle/README.md).

Для проекта выбирается одна реализация `subtitle`. Она использует стабильный slug `subtitle` и класс `is-style-subtitle`. Остальные реализации остаются здесь. Дополнительные файлы добавлять только при необходимости; собственная сборка темы не вводится.

Описание variation создаётся по [шаблону](../templates/style-variation.md), описание её реализации — по [шаблону варианта](../templates/variant.md).

[Icon](icon/README.md) — базовый Plain и варианты Circle и Rounded square; коллекция SVG остаётся в плагине.
