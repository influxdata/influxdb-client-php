import "date"

from(bucket: "my-bucket")
  |> range(start: -10d)
  |> filter(fn: (r) => r["_measurement"] == "weather" and r["_field"] == "temperature" and r["location"] == "Prague")
  |> pivot(rowKey:["_time"], columnKey: ["_field"], valueColumn: "_value")
  |> map(fn: (r) => ({ r with weekDay: date.weekDay(t: r._time) }))
