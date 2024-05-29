<template>
    <div class="container mt-5">
        <h2>Edit Employee</h2>
        <form @submit.prevent="updateEmployee">
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="employee.name"
                    required
                    minlength="3"
                    maxlength="25"
                />
            </div>

            <div class="form-group">
                <label>Gender</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="genderMale"
                            value="male"
                            v-model="employee.gender"
                        />
                        <label class="form-check-label" for="genderMale"
                            >Male</label
                        >
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="genderFemale"
                            value="female"
                            v-model="employee.gender"
                        />
                        <label class="form-check-label" for="genderFemale"
                            >Female</label
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Department</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="departmentIT"
                            value="IT"
                            v-model="employee.department"
                        />
                        <label class="form-check-label" for="departmentIT"
                            >IT</label
                        >
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="departmentHR"
                            value="HR"
                            v-model="employee.department"
                        />
                        <label class="form-check-label" for="departmentHR"
                            >HR</label
                        >
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="departmentAdmin"
                            value="admin"
                            v-model="employee.department"
                        />
                        <label class="form-check-label" for="departmentAdmin"
                            >Admin</label
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Education</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="educationMBA"
                            value="MBA/MCA"
                            v-model="employee.education"
                        />
                        <label class="form-check-label" for="educationMBA"
                            >MBA/MCA</label
                        >
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="educationBE"
                            value="BE/BTech"
                            v-model="employee.education"
                        />
                        <label class="form-check-label" for="educationBE"
                            >BE/B Tech</label
                        >
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            id="educationME"
                            value="ME/MTech"
                            v-model="employee.education"
                        />
                        <label class="form-check-label" for="educationME"
                            >ME/M Tech</label
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="salary">Salary</label>
                <select
                    class="form-control"
                    id="salary"
                    v-model="employee.salary"
                >
                    <option value="Less than 1L">Less than 1L</option>
                    <option value="1 to 3L">1 to 3L</option>
                    <option value="More than 3L">More than 3L</option>
                </select>
            </div>

            <div class="form-group">
                <label>Hobbies</label>
                <div>
                    <div
                        class="form-check form-check-inline"
                        v-for="hobby in hobbiesOptions"
                        :key="hobby"
                    >
                        <input
                            class="form-check-input"
                            type="checkbox"
                            :id="`hobby${hobby}`"
                            :value="hobby"
                            v-model="employee.hobbies"
                        />
                        <label
                            class="form-check-label"
                            :for="`hobby${hobby}`"
                            >{{ hobby }}</label
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input
                    type="date"
                    class="form-control"
                    id="dob"
                    v-model="employee.dob"
                />
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

export default {
    name: "EmployeeEdit",
    setup() {
        const route = useRoute();
        const router = useRouter();
        const employee = ref({
            name: "",
            gender: "",
            department: "",
            education: "",
            salary: "",
            hobbies: [],
            dob: "",
        });
        const hobbiesOptions = ["Chess", "Cricket", "Reading", "Swimming"];

        const fetchEmployee = async () => {
            try {
                const response = await axios.get(
                    `/api/employees/${route.params.id}`
                );
                employee.value = response.data;
            } catch (error) {
                console.error("Error fetching employee:", error);
            }
        };

        const updateEmployee = async () => {
            try {
                await axios.put(
                    `/api/employees/${route.params.id}`,
                    employee.value
                );
                router.push({ name: "Home" });
            } catch (error) {
                console.error("Error updating employee:", error);
            }
        };

        onMounted(() => {
            fetchEmployee();
        });

        return {
            employee,
            hobbiesOptions,
            updateEmployee,
        };
    },
};
</script>
