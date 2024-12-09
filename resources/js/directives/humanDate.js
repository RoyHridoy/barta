import dayjs from "dayjs"
import relativeTime from 'dayjs/plugin/relativeTime'
import timezone from 'dayjs/plugin/timezone'
import utc from 'dayjs/plugin/utc'

dayjs.extend(relativeTime)
dayjs.extend(timezone)
dayjs.extend(utc)

dayjs.tz.setDefault('UTC')

export default (el) => {
    let datetime = el.getAttribute('datetime')

    if (!datetime) {
        return
    }

    const setHumanDate = () => {
        el.innerText = dayjs().tz().to(dayjs.tz(datetime))
    }
    setHumanDate()
    setInterval(setHumanDate, 40000)
}
