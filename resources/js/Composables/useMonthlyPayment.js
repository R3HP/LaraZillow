import { computed , isRef } from "vue";

export const useMonthlyPayment = (totalPrice,interestRate,duration)=>{
    const monthlyPayment = computed(() => {
        const principle = isRef(totalPrice) ? totalPrice.value : totalPrice
        const monthlyInterest = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12
        const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration) * 12
        return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
    })

    const totalPaid = computed(() => (isRef(duration) ? duration.value : duration) * 12 * monthlyPayment.value);

    const totalInterest = computed(() => totalPaid.value - (isRef(totalPrice) ? totalPrice.value : totalPrice))


    return { monthlyPayment , totalPaid , totalInterest }
}