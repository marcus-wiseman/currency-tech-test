<template>
    <div>

        <div v-if="error && result == ''" class="alert alert-danger" role="alert">
            {{ error }}
        </div>

        <h2 v-if="result != '' && !error" class="mb-3">
            <span class="font-weight-bold">{{amount}} {{ base_currecy }}</span> =
            <span class="font-weight-bold" >{{ result }} {{ target_currency }}</span>
        </h2>

        <input type="hidden" v-model="base_currecy"/>

        <div class="text-left">Please enter amount:</div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">GBP</span>
            </div>
            <input @keypress="reset" @change="reset" v-model="amount" type="number" min="0.01" step="1"
            class="form-control" aria-label="Amount" placeholder="0.00" />
        </div>

        <div class="text-left">Select conversion rate:</div>
        <div class="input-group mb-3">
            <select v-model="target_currency" class="custom-select">
                <option v-for="code in currencyOptions" v-bind:value="code.code">
                    {{ code.code }} - {{ code.name }}
                </option>
            </select>
        </div>

        <button type="button" v-on:click="convert" class="btn btn-primary">Convert</button>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                currencyOptions: null,
                amount: "",
                base_currecy: "GBP",
                target_currency: "USD",
                result: "",
                error: null
            };
        },

        mounted() {
            let $_this = this;
            axios.get("/api/v1/currency/codes").then(function (response) {
                $_this.currencyOptions = response.data.data;
            });
        },

        methods: {

            reset: function() {
                this.result = '';
                this.error = null;
            },

            convert: function() {
                var $_this = this;

                $_this.error = null;
                $_this.result = '';

                axios.post("/api/v1/currency/convert", {
                    "amount": $_this.amount,
                    "base_currency": $_this.base_currecy,
                    "target_currency": $_this.target_currency
                }).then(function (response) {
                    if (!response.data.status) {
                        $_this.error = Object.values(response.data.errors)[0][0];
                        return;
                    }
                    $_this.result = response.data.amount;
                });
            }
        }
    };
</script>
