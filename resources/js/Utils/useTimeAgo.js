import { ref, computed, onMounted, onUnmounted } from 'vue';

export default function useTimeAgo(date) {
    const timeAgo = ref('');
    const interval = ref(null);

    const calculateTimeAgo = () => {
        const now = new Date();
        const pastDate = new Date(date);
        const seconds = Math.floor((now - pastDate) / 1000);

        if (seconds < 60) return `${seconds} seconds ago`;
        const minutes = Math.floor(seconds / 60);
        if (minutes < 60) return `${minutes} minutes ago`;
        const hours = Math.floor(minutes / 60);
        if (hours < 24) return `${hours} hours ago`;
        const days = Math.floor(hours / 24);
        if (days < 30) return `${days} days ago`;
        const months = Math.floor(days / 30);
        if (months < 12) return `${months} months ago`;
        const years = Math.floor(months / 12);
        return `${years} years ago`;
    };

    const updateTimeAgo = () => {
        timeAgo.value = calculateTimeAgo();
    };

    onMounted(() => {
        updateTimeAgo();
        interval.value = setInterval(updateTimeAgo, 60000);
    });

    onUnmounted(() => {
        if (interval.value) clearInterval(interval.value);
    });

    return computed(() => timeAgo.value);
}