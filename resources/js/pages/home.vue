<template>
    <div class="container">
        <button type="button" class="btn btn-dark" @click="addEmployee">
            Add Employee
        </button>
        <div class="row mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Department</th>
                        <th scope="col">Education</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Hobbies</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td>{{ employee.gender }}</td>
                        <td>{{ employee.department }}</td>
                        <td>{{ employee.education }}</td>
                        <td>{{ employee.salary }}</td>
                        <td>{{ employee.hobbies.join(", ") }}</td>
                        <td>
                            {{
                                employee.dob &&
                                new Date(employee.dob).toLocaleDateString()
                            }}
                        </td>
                        <td>
                            <button
                                class="btn btn-primary btn-sm mr-2"
                                @click="editEmployee(employee.id)"
                            >
                                Edit
                            </button>
                            <button
                                class="btn btn-danger btn-sm"
                                @click="deleteEmployee(employee.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { useRouter } from "vue-router";
import { ref, onMounted } from "vue";
import { useStore } from "vuex";

export default {
    setup() {
        const router = useRouter();
        const store = useStore();
        const employees = ref([]);

        function addEmployee() {
            router.push({ name: "AddEmployee" });
        }

        const fetchEmployees = async () => {
            try {
                const response = await axios.get("/api/employees");
                console.log("ADSf", response.data.data);
                employees.value = response.data.data;
            } catch (error) {
                console.error("Error fetching employees:", error);
            }
        };

        const deleteEmployee = async (id) => {
            try {
                await axios.delete(`/api/employees/${id}`);
                fetchEmployees(); // Refresh the employee list after deletion
            } catch (error) {
                console.error("Error deleting employee:", error);
            }
        };

        const editEmployee = (id) => {
            router.push({ name: "EditEmployee", params: { id } });
        };

        onMounted(() => {
            fetchEmployees();
        });

        return { addEmployee, employees, deleteEmployee, editEmployee };
    },
};
</script>
