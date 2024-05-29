<template>
    <div class="container mt-5">
        <h2>Employee Form</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    class="form-control"
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
                            required
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
                            required
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
                            required
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
                            required
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
                            required
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
                            required
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
                            required
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
                            required
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
                    id="salary"
                    class="form-control"
                    v-model="employee.salary"
                    required
                >
                    <option disabled value="">Select Salary</option>
                    <option value="Less than 1L">Less than 1L</option>
                    <option value="1 to 3L">1 to 3L</option>
                    <option value="More than 3L">More than 3L</option>
                </select>
            </div>

            <div class="form-group">
                <label>Hobbies</label>
                <div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="hobbyChess"
                            value="Chess"
                            v-model="employee.hobbies"
                        />
                        <label class="form-check-label" for="hobbyChess"
                            >Chess</label
                        >
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="hobbyCricket"
                            value="Cricket"
                            v-model="employee.hobbies"
                        />
                        <label class="form-check-label" for="hobbyCricket"
                            >Cricket</label
                        >
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="hobbyReading"
                            value="Reading"
                            v-model="employee.hobbies"
                        />
                        <label class="form-check-label" for="hobbyReading"
                            >Reading</label
                        >
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="hobbySwimming"
                            value="Swimming"
                            v-model="employee.hobbies"
                        />
                        <label class="form-check-label" for="hobbySwimming"
                            >Swimming</label
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input
                    type="date"
                    id="dob"
                    class="form-control"
                    v-model="employee.dob"
                    required
                />
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();
        let employee = reactive({
            name: "",
            gender: "",
            department: "",
            education: "",
            salary: "",
            hobbies: [],
            dob: "",
        });

        async function submitForm() {
            await axios.post("/api/employees", employee).then((res) => {
                if (res.data.success) {
                    router.push({ name: "Home" });
                }
            });
        }

        return { employee, submitForm };
    },
};
</script>
