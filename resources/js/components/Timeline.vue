<template>
    <!--
      The hairline is drawn on the list itself, so items only have to position
      their own node against it. `TimelineItem` supplies the left padding.
    -->
    <ol class="relative space-y-10 border-l border-border">
        <slot />
    </ol>
</template>
