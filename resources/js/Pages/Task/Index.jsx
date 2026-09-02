import { useForm, router } from "@inertiajs/react";
export default function Index({ tasks }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        title: "",
    });
    function addTask(e) {
        e.preventDefault();
        post("/tasks", {
            onSuccess: () => reset("title"),
        });
    }
    function toggleTask(task) {
        router.patch(`/tasks/${task.id}`, {
            is_done: !task.is_done,
        });
    }
    function deleteTask(task) {
        router.delete(`/tasks/${task.id}`);
    }
    return (
        <div style={{ maxWidth: 480, margin: "40px auto", fontFamily: "sans-serif" }}>
            <h1>Task Manager</h1>
            <form onSubmit={addTask} style={{ display: "flex", gap: 8, marginBottom: 20 }}>
                <input
                    type="text"
                    placeholder="New task..."
                    value={data.title}
                    onChange={(e) => setData("title", e.target.value)}
                />
                <button type="submit" disabled={processing}>
                    Add Task
                </button>
            </form>
            {errors.title && <p style={{ color: "red" }}>{errors.title}</p>}
            <ul style={{ listStyle: "none", padding: 0 }}>
                {tasks.map((task) => (
                    <li
                        key={task.id}
                        style={{
                            display: "flex",
                            justifyContent: "space-between",
                            alignItems: "center",
                            padding: "8px 0",
                            borderBottom: "1px solid #eee",
                        }}
                    >
                        <span
                            onClick={() => toggleTask(task)}
                            style={{
                                cursor: "pointer",
                                textDecoration: task.is_done ? "line-through" : "none",
                            }}
                        >
                            {task.title}
                        </span>
                        <button onClick={() => deleteTask(task)}>Delete</button>
                    </li>
                ))}
            </ul>
            {tasks.length === 0 && <p>No tasks yet — add one above.</p>}
        </div>
    );
}