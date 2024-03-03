
<template>
    <div class="paginator">
        <Link v-for="link in links" class="p-link" :class="link.url ? 'num-p-link' : 'side-p-link'" :href="link.url ?? '#'">
        {{ link.label }}
        </Link>
    </div>
</template>


<script>

import { Link } from '@inertiajs/vue3';

export default {

    components: {
        Link,
    },

    props: {
        links: Array
    },

}

</script>
